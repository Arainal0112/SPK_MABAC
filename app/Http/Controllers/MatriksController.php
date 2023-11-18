<?php

namespace App\Http\Controllers;

use App\Models\Matriks;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class MatriksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alt = Alternatif::all();
        $krit = Kriteria::all();
        $matriks = Matriks::all();
        return view('matriks.index', compact('alt', 'krit', 'matriks'));
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
        $matriks = Matriks::where("alternatif_id", $id);
        $alt = Alternatif::find($id);
        $krit = Kriteria::all();
        return view('matriks.edit',compact('matriks','alt','krit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matriks $matrik)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matriks $matrik)
    {
        //
    }
}
