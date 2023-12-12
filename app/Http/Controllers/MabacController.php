<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Matriks;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MabacController extends Controller
{
    public function index()
    {
        $matriks = Matriks::all();
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();

        // Ambil nama kriteria untuk header tabel
        $kriteriaNames = Kriteria::pluck('nama_kriteria', 'id')->toArray();

        // Jika tidak ada data, kembalikan ke view dengan pesan
        // if ($matriks->isEmpty()) {
        //     return view('hasil.index')->with('error', 'Tidak ada data Decision Matrix yang tersimpan.');
        // }

        // Buat array untuk menyimpan data yang akan ditampilkan di view
        $matrixTable = [];

        // Loop untuk menyusun data ke samping berdasarkan id_alternatif
        foreach ($matriks as $data) {
            $matrixTable[$data->alternatif_id][$data->kriteria_id] = $data->nilai;
        }

        // Ambil nama alternatif untuk ditampilkan di view
        $alternatifNames = Alternatif::pluck('nama_alternatif', 'id')->toArray();
        // Kirim data ke view


        // Normalisasi
        $normalisasi = $this->hitungNormalisasi($matrixTable);

        // Perhitungan Matriks Terimbang (V)
        $matriksTerimbang = $this->hitungMatriksTerimbang($normalisasi, $kriteria);

        // Perhitungan Matriks Perkiraan Batas (G)
        $matriksBatas = $this->hitungMatriksBatas($matriksTerimbang);

        // // Perhitungan Matriks Q
        $matriksQ = $this->hitungMatriksJarakAlternatif($matriksTerimbang, $matriksBatas);

        // Perangkingan
        $ranking = $this->perangkingan($matriksQ);

        // Menghitung banyak data yang bernilai minus
        $jmlberhak =  $this->jumlahberhak($ranking);

        return view('hasil.index', compact('matrixTable', 'kriteriaNames', 'alternatifNames', 'normalisasi', 'matriksTerimbang', 'matriksBatas', 'matriksQ', 'ranking'));
    }

    private function hitungNormalisasi($matrixTable)
    {
        // Mendapatkan nilai maksimum dan minimum untuk setiap kriteria
        $maxValues = [];
        $minValues = [];

        foreach ($matrixTable as $alternatif => $kriteriaData) {
            foreach ($kriteriaData as $kriteria => $nilai) {
                if (!isset($maxValues[$kriteria]) || $nilai > $maxValues[$kriteria]) {
                    $maxValues[$kriteria] = $nilai;
                }

                if (!isset($minValues[$kriteria]) || $nilai < $minValues[$kriteria]) {
                    $minValues[$kriteria] = $nilai;
                }
            }
        }

        // Normalisasi nilai matriks
        $normalizedMatrix = [];

        foreach ($matrixTable as $alternatif => $kriteriaData) {
            foreach ($kriteriaData as $kriteria => $nilai) {
                $objKriteria = Kriteria::find($kriteria);
                // Additional check to avoid division by zero
                if ($maxValues[$kriteria] - $minValues[$kriteria] != 0) {
                    if ($objKriteria->jenis == 'cost') {
                        // Normalisasi menggunakan rumus (nilai - nilai_min) / (nilai_max - nilai_min)
                        $normalizedValue = ($nilai - $maxValues[$kriteria]) / ($minValues[$kriteria] - $maxValues[$kriteria]);
                        $normalizedMatrix[$alternatif][$kriteria] = $normalizedValue;
                    } else {
                        // Normalisasi menggunakan rumus (nilai - nilai_min) / (nilai_max - nilai_min)
                        $normalizedValue = ($nilai - $minValues[$kriteria]) / ($maxValues[$kriteria] - $minValues[$kriteria]);
                        $normalizedMatrix[$alternatif][$kriteria] = $normalizedValue;
                    }
                } else {
                    $normalizedMatrix[$alternatif][$kriteria] = 0;
                }
            }
        }

        // Kembalikan matriks yang sudah dinormalisasi
        return $normalizedMatrix;
    }

    private function hitungMatriksTerimbang($normalisasi, $kriteria)
    {
        $matriksTerimbang = [];

        foreach ($normalisasi as $alternatif => $kriteriaData) {
            foreach ($kriteriaData as $kriteria => $nilai) {
                // Ambil objek Kriteria terkait dengan id
                $objKriteria = Kriteria::find($kriteria);

                // Pastikan objek Kriteria ditemukan sebelum mengakses properti
                if ($objKriteria) {
                    // Hitung matriks terimbang menggunakan rumus normalisasi * bobot kriteria
                    $nilai_bobot = $objKriteria->bobot / 100;
                    $matriksTerimbang[$alternatif][$kriteria] = ($nilai * $nilai_bobot) + $nilai_bobot;
                }
            }
        }

        return $matriksTerimbang;
    }

    private function hitungMatriksBatas($matriksTerimbang)
    {
        // Menghitung matriks batas
        $matriksBatas = [];

        foreach ($matriksTerimbang as $alternatif => $kriteriaData) {
            foreach ($kriteriaData as $kriteria => $nilai) {
                if (!isset($matriksBatas[$kriteria])) {
                    $matriksBatas[$kriteria] = 1;
                }
                // Mengalikan semua nilai kriteria yang memiliki id yang sama
                $matriksBatas[$kriteria] *= $nilai;
            }
        }

        // Menghitung banyaknya alternatif
        $banyakAlternatif = count($matriksTerimbang);

        // Operasi pada matriks batas sesuai rumus
        foreach ($matriksBatas as $kriteria => $nilai) {
            $matriksBatas[$kriteria] = pow($nilai, 1 / $banyakAlternatif);
        }

        // Hasil akhir adalah matriks batas
        return $matriksBatas;
    }

    private function hitungMatriksJarakAlternatif($matriksTerimbang, $matriksBatas)
    {
        // Menghitung matriks jarak alternatif
        $matriksJarakAlternatif = [];

        foreach ($matriksTerimbang as $alternatif => $kriteriaData) {
            foreach ($kriteriaData as $kriteria => $nilai) {
                // Menghitung nilai matriks jarak alternatif sesuai rumus
                $matriksJarakAlternatif[$alternatif][$kriteria] = $nilai - $matriksBatas[$kriteria];
            }
        }

        return $matriksJarakAlternatif;
    }

    private function perangkingan($matriksQ)
    {
        // Jumlahkan nilai Q untuk setiap alternatif
        $totalQ = [];

        foreach ($matriksQ as $alternatif => $kriteriaData) {
            $totalQ[$alternatif] = array_sum($kriteriaData);
        }

        // Urutkan alternatif berdasarkan nilai total Q secara ascending
        arsort($totalQ);

        return $totalQ;
    }
    // Fungsi untuk menghitung banyak data yang bernilai minus
    public function jumlahberhak($ranking)
    {
        $count = 0;

        foreach ($ranking as $value) {
            if ($value < 0) {
                $count++;
            }
        }

        return $count;
    }
    public function cetak_pdf()
    {
        $matriks = Matriks::all();
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $sub = SubKriteria::all();

        // Ambil nama kriteria untuk header tabel
        $kriteriaNames = Kriteria::pluck('nama_kriteria', 'id')->toArray();


        // Buat array untuk menyimpan data yang akan ditampilkan di view
        $matrixTable = [];

        // Loop untuk menyusun data ke samping berdasarkan id_alternatif
        foreach ($matriks as $data) {
            $matrixTable[$data->alternatif_id][$data->kriteria_id] = $data->nilai;
        }

        // Ambil nama alternatif untuk ditampilkan di view
        $alternatifNames = Alternatif::pluck('nama_alternatif', 'id')->toArray();
        // Kirim data ke view


        // Normalisasi
        $normalisasi = $this->hitungNormalisasi($matrixTable);

        // Perhitungan Matriks Terimbang (V)
        $matriksTerimbang = $this->hitungMatriksTerimbang($normalisasi, $kriteria);

        // Perhitungan Matriks Perkiraan Batas (G)
        $matriksBatas = $this->hitungMatriksBatas($matriksTerimbang);

        // // Perhitungan Matriks Q
        $matriksQ = $this->hitungMatriksJarakAlternatif($matriksTerimbang, $matriksBatas);

        // Perangkingan
        $ranking = $this->perangkingan($matriksQ);

        // Menghitung banyak data yang bernilai minus
        $jmlberhak =  $this->jumlahberhak($ranking);
        $pdf = PDF::loadview('matriks.cetak_pdf', compact('sub','matrixTable', 'kriteriaNames', 'alternatifNames', 'normalisasi', 'matriksTerimbang', 'matriksBatas', 'matriksQ', 'ranking'));
        return $pdf->stream();
        // return view('matriks.cetak_pdf', compact('sub','matrixTable', 'kriteriaNames', 'alternatifNames', 'normalisasi', 'matriksTerimbang', 'matriksBatas', 'matriksQ', 'ranking'));
    }
}
