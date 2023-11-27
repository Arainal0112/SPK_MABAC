<?php

namespace App\Http\Controllers;

use App\Models\Matriks;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatriksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data DecisionMatrix dari database
        $matrik = Matriks::all();

        // Jika tidak ada data, kembalikan ke view dengan pesan
        if ($matrik->isEmpty()) {
            return view('matriks.index')->with('error', 'Tidak ada data Decision Matrix yang tersimpan.');
        }

        // Buat array untuk menyimpan data yang akan ditampilkan di view
        $matrixTable = [];

        // Loop untuk menyusun data ke samping berdasarkan id_alternatif
        foreach ($matrik as $data) {
            $matrixTable[$data->alternatif_id][$data->kriteria_id] = $data->nilai;
        }

        // Ambil nama kriteria untuk header tabel
        $kriteriaNames = DB::table('kriteria')->pluck('nama_kriteria', 'id')->toArray();
        // Ambil nama alternatif untuk ditampilkan di view
        $alternatifNames = Alternatif::pluck('nama_alternatif', 'id')->toArray();

        $sub = SubKriteria::all();
        // Kirim data ke view
        return view('matriks.index', compact('matrixTable', 'kriteriaNames', 'alternatifNames', 'sub'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alt = Alternatif::all();
        $krit = Kriteria::all();
        $sub = SubKriteria::all();
        return view('matriks.create', compact('alt', 'krit', 'sub'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'alternatif' => 'required',
            // Perubahan pada validasi input kriteria
            'kriteria_*' => 'required',
            'nilai_*' => 'required',
        ]);

        // Memproses data untuk setiap kriteria
        $krit = Kriteria::all();
        foreach ($krit as $Krit) {
            $matriks = new Matriks;
            // Menggunakan kriteria yang sesuai dengan loop
            $matriks->kriteria_id = $request->get('kriteria_' . $Krit->id);
            $matriks->alternatif_id = $request->get('alternatif');
            // Menggunakan nilai yang sesuai dengan loop
            $matriks->nilai = $request->get('nilai_' . $Krit->id);
            $matriks->save();
        }


        return redirect()->route('matriks.index')->with('success', 'Data Kriteria Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matriks $matrik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $matriks = Matriks::where("alternatif_id", $id)->get();
        $alt = Alternatif::find($id);
        $krit = Kriteria::all();
        $sub = SubKriteria::all();
        return view('matriks.edit', compact('matriks', 'alt', 'krit', 'sub'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // Perubahan pada validasi input kriteria
            'kriteria_*' => 'required',
            'nilai_*' => 'required',
        ]);

        // Memproses data untuk setiap kriteria
        $krit = Kriteria::all();
        foreach ($krit as $Krit) {
            
            // Menggunakan kriteria yang sesuai dengan loop
            $id_kriteria = $request->get('kriteria_' . $Krit->id);
            $matriks = Matriks::where('alternatif_id', $id)
            ->where('kriteria_id', $id_kriteria)->first();
            // Menggunakan nilai yang sesuai dengan loop
            $matriks->nilai = $request->get('nilai_' . $Krit->id);
            $matriks->save();
        }


        return redirect()->route('matriks.index')->with('success', 'Data Kriteria Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Matriks::where('alternatif_id', $id)->delete();
        return redirect()->route('matriks.index')
            ->with('success', 'Data Berhasil Dihapus');
    }
}
