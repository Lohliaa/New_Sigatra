<?php

namespace App\Http\Controllers;

use App\Models\MOU;
use App\Models\SK;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mou = MOU::orderBy('id', 'asc')->get();

        $sk = SK::orderBy('id', 'asc')->get();

        $fields = ['tgl_mou', 'tanggal_lahir', 'tgl_mulai', 'tanggal_mulai','tanggal_akhir', 'tanggal_ditetapkan'];

        return view('admin.dashboard', compact('mou', 'sk'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
