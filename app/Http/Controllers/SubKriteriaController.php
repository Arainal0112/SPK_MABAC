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
        // Mengakses data sub_kriteria dari form
        $subKriteriaData = $request->only(['sub_alt_1', 'sub_alt_2', 'sub_alt_3', 'sub_alt_4', 'sub_alt_5']);

        // Menghitung jumlah sub_kriteria yang sudah ditambahkan
        $jmlSubKriteria = count($subKriteriaData);

        // Menyimpan data sub_kriteria ke database
        for ($i = 1; $i <= $jmlSubKriteria; $i++) {
            $sub_kriteria = new SubKriteria; // Buat objek baru di setiap iterasi
        
            $value = $subKriteriaData['sub_alt_' . $i];
            
            $sub_kriteria->nama_sub = $value;
            $sub_kriteria->nilai_sub = $i;

            $kriteria = new Kriteria;
            $kriteria->id = $request->get('kriteria');

            $sub_kriteria->kriteria()->associate($kriteria);
            $sub_kriteria->save();
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
        
        return redirect()->route('kriteria.index')
            ->with('success', 'Data Berhasil Dihapus');
    }
}
