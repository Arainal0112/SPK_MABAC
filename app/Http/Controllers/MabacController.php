<?php

namespace App\Http\Controllers;

use App\Models\Matriks;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MabacController extends Controller
{
    public function index()
    {
        $matriks = Matriks::all();
        $kriteria = Kriteria::all();
        // Jika tidak ada data, kembalikan ke view dengan pesan
        if ($matriks->isEmpty()) {
            return view('hasil.index')->with('error', 'Tidak ada data Decision Matrix yang tersimpan.');
        }

        // Buat array untuk menyimpan data yang akan ditampilkan di view
        $matrixTable = [];

        // Loop untuk menyusun data ke samping berdasarkan id_alternatif
        foreach ($matriks as $data) {
            $matrixTable[$data->alternatif_id][$data->kriteria_id] = $data->nilai;
        }

        // Ambil nama kriteria untuk header tabel
        $kriteriaNames = DB::table('kriteria')->pluck('nama_kriteria', 'id')->toArray();
        // Ambil nama alternatif untuk ditampilkan di view
        $alternatifNames = Alternatif::pluck('nama_alternatif', 'id')->toArray();
        // Kirim data ke view


        // Normalisasi
        $normalisasi = $this->hitungNormalisasi($matrixTable);

        // Perhitungan Matriks Terimbang (V)
        $matriksTerimbang = $this->hitungMatriksTerimbang($normalisasi, $kriteria);

        // Perhitungan Matriks Perkiraan Batas (G)
        $matriksBatas = $this->hitungMatriksBatas($matriksTerimbang, count($matrixTable));

        // // Perhitungan Matriks Q
        // $matriksQ = $this->hitungMatriksQ($matriksTerimbang, $matriksBatas);

        // Perangkingan
        // $ranking = $this->perangkingan($matriksQ);

        return view('hasil.index', compact('matrixTable', 'kriteriaNames', 'alternatifNames', 'normalisasi','matriksTerimbang',));
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
                // Normalisasi menggunakan rumus (nilai - nilai_min) / (nilai_max - nilai_min)
                $normalizedValue = ($nilai - $minValues[$kriteria]) / ($maxValues[$kriteria] - $minValues[$kriteria]);
                $normalizedMatrix[$alternatif][$kriteria] = $normalizedValue;
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
                    $matriksTerimbang[$alternatif][$kriteria] = ($nilai * $objKriteria->bobot)+$objKriteria->bobot;
                }
            }
        }

        return $matriksTerimbang;
    }

    private function hitungMatriksBatas($matriksTerimbang, $jumlahAlternatif)
    {
        $matriksBatas = [];

    foreach ($matriksTerimbang as $alternatif => $kriteriaData) {
        foreach ($kriteriaData as $kriteria => $nilai) {
            // Hitung matriks batas menggunakan rumus terimbang pangkat 1/banyak alternatif
            $matriksBatas[$alternatif][$kriteria] = pow($nilai, 1 / $jumlahAlternatif);
        }
    }

    return $matriksBatas;

        return $matriksBatas;
    }

    private function hitungMatriksQ($matriksTerimbang, $matriksBatas)
    {
        $matriksQ = [];

        foreach ($matriksTerimbang as $alternatif => $kriteriaData) {
            $sumBatas = array_sum($matriksBatas[$alternatif]);

            foreach ($kriteriaData as $kriteria => $nilai) {
                // Hitung matriks Q menggunakan rumus terimbang^2 / sum(batas)
                $matriksQ[$alternatif][$kriteria] = pow($nilai, 2) / $sumBatas;
            }
        }

        return $matriksQ;
    }

    private function perangkingan($matriksQ)
    {
        // Jumlahkan nilai Q untuk setiap alternatif
        $totalQ = [];

        foreach ($matriksQ as $alternatif => $kriteriaData) {
            $totalQ[$alternatif] = array_sum($kriteriaData);
        }

        // Urutkan alternatif berdasarkan nilai total Q secara descending
        arsort($totalQ);

        return $totalQ;
    }
}
