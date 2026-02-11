<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use Illuminate\Http\Request;

class PejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pejabat = Pejabat::orderBy('id', 'asc')->get();
        return view('pejabat.index', compact('pejabat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'status' => 'required|string',
            'unit' => 'required|string',

        ]);

        Pejabat::create($validated);

        return redirect()
            ->route('pejabat.index')
            ->with('success', 'Pejabat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pejabat = Pejabat::findOrFail($id);
        return view('pejabat.show', compact('pejabat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pejabat = Pejabat::findOrFail($id);
        return view('pejabat.edit', compact('pejabat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pejabat = Pejabat::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'status' => 'required|string',
            'unit' => 'required|string',
        ]);

        $pejabat->update($validated);

        return redirect()
            ->route('pejabat.index')
            ->with('success', 'Pejabat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pejabat = Pejabat::findOrFail($id);
        $pejabat->delete();

        return redirect()
            ->route('pejabat.index')
            ->with('success', 'Pejabat berhasil dihapus');
    }
}
