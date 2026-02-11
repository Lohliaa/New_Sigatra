<?php

namespace App\Http\Controllers;

use App\Models\Bahan_Penilaian;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bahan_penilaian = Bahan_Penilaian::orderBy('id', 'asc')->get();
        $data = $bahan_penilaian;

        return view('bahan_penilaian_kinerja.index', compact('bahan_penilaian', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //    return view('bahan_penilaian_kinerja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        Bahan_Penilaian::create([
            'link' => $request->link
        ]);

        return redirect()
            ->route('bahan_penilaian.index')
            ->with('success', 'Link berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bahan_penilaian = Bahan_Penilaian::findOrFail($id);
        return view('bahan_penilaian_kinerja.read', compact('bahan_penilaian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bahan_penilaian = Bahan_Penilaian::findOrFail($id);
        return view('bahan_penilaian_kinerja.edit', compact('bahan_penilaian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        Bahan_Penilaian::findOrFail($id)->update([
            'link' => $request->link
        ]);

        return redirect()
            ->route('bahan_penilaian.index')
            ->with('success', 'Data berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bahan_penilaian = Bahan_Penilaian::findOrFail($id);
        $bahan_penilaian->delete();

        return redirect()->route('bahan_penilaian.index')->with('success', 'Data berhasil dihapus.');
    }
}
