<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periode = Periode::orderBy('id', 'asc')->get();
        return view('periode.index', compact('periode'));
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
            'kuartal' => 'required|string',
            'periode' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        Periode::create($validated);

        return redirect()
            ->route('periode.index')
            ->with('success', 'Periode berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $periode = Periode::findOrFail($id);
        return view('periode.show', compact('periode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $periode = Periode::findOrFail($id);
        return view('periode.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $periode = Periode::findOrFail($id);

        $validated = $request->validate([
            'kuartal' => 'required|string',
            'periode' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $periode->update($validated);

        return redirect()
            ->route('periode.index')
            ->with('success', 'Periode berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();

        return redirect()
            ->route('periode.index')
            ->with('success', 'Periode berhasil dihapus');
    }
}
