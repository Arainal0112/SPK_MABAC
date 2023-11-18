<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Http\Requests\StoreKriteriaRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use App\Models\Matriks;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('kriteria.index', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required',
        ]);

        $kriteria = new Kriteria;
        $kriteria->kode_kriteria = $request->get('kode_kriteria');
        $kriteria->nama_kriteria = $request->get('nama_kriteria');
        $kriteria->bobot = $request->get('bobot');
        $kriteria->jenis = $request->get('jenis');
        $kriteria->save();

        
        return redirect()->route('kriteria.index')->with('success', 'Data Kriteria Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriteria)
    {
        $kriteria = Kriteria::all();
        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        $sub = SubKriteria::where('id', $id);
        return view('kriteria.edit', compact('kriteria', 'sub'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::where('id', $id)->first();

        $kriteria->kode_kriteria = $request->get('kode_kriteria');
        $kriteria->nama_kriteria = $request->get('nama_kriteria');
        $kriteria->bobot = $request->get('bobot');
        $kriteria->jenis = $request->get('jenis');


        $kriteria->save();
        
        return redirect()->route('kriteria.index')
            ->with('success', 'Data Kriteria Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Hapus sub-kriteria yang terkait secara manual
        SubKriteria::where('kriteria_id', $id)->delete();
        Matriks::where('kriteria_id',$id)->delete();
        Kriteria::find($id)->delete();

        return redirect()->route('kriteria.index')
            ->with('success', 'Data Berhasil Dihapus');
    }
}
