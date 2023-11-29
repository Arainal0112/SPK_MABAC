<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use App\Http\Requests\StoreSubKriteriaRequest;
use App\Http\Requests\UpdateSubKriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub = SubKriteria::all();
        $kriteria = Kriteria::all();
        return view('sub_kriteria.index', compact('sub', 'kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('sub_kriteria.create',compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new SubkritModel instance
        

        // Loop through the sub_krit and nilai_sub fields dynamically
        for ($i = 1; $i <= $request->input('counter'); $i++) {
            $subkrit = new SubKriteria;
            $subkrit->kriteria_id = $request->input('kriteria');

            $subkritField = 'sub_krit_' . $i;
            $nilaiSubField = 'nilai_sub_' . $i;

            // Check if the nilai_sub field is empty, set placeholder if it is
            $nilaiSubValue = $request->filled($nilaiSubField) ? $request->input($nilaiSubField) : $i;

            // Set values for sub_krit and nilai_sub in the model

            $subkrit->nama_sub = $request->input($subkritField);
            $subkrit->nilai_sub = $nilaiSubValue;
            $subkrit->save();
        }

        return redirect()->route('sub.index')->with('success', 'Data Sub Kriteria Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sub = SubKriteria::find($id);
        return view('sub_kriteria.edit', compact('sub'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sub = SubKriteria::where('id', $id)->first();

        $sub->nama_sub = $request->get('nama_sub');
        $sub->nilai_sub = $request->get('nilai_sub');


        $sub->save();
        return redirect()->route('sub.index')
            ->with('success', 'Data Sub kriteria Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        SubKriteria::find($id)->delete();
        
        return redirect()->route('sub.index')
            ->with('success', 'Data Berhasil Dihapus');
    }
}
