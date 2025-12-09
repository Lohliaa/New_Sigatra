<?php

namespace App\Http\Controllers;

use App\Exports\MOUExport;
use App\Imports\MOUImport;
use App\Models\MOU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;

class MOUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mou = MOU::orderBy('id', 'asc')->get();
        $data = $mou;

        $fields = ['tgl_mou', 'tanggal_lahir', 'tgl_mulai', 'tanggal_akhir'];

        return view('admin.mou.index', compact('mou', 'data'));
    }

    public function export()
    {
        return Excel::download(new MOUExport, 'Data MOU Gupeg SIT Permata.xlsx');
    }

    public function upload()
    {
        return view('mou.upload');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new MOUImport, $request->file('file'));

        return back()->with('success', 'Data berhasil diimpor!');
    }

    public function uploadProcess(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Jalankan import
        Excel::import(new MOUImport, $request->file('file'));

        return redirect()->route('mou.index')->with('success', 'Data MOU berhasil diupload.');
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
        $mou = MOU::findOrFail($id);
        return view('admin.mou.read', compact('mou'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mou = Mou::findOrFail($id);
        return view('admin.mou.edit', compact('mou'));
    }

    public function update(Request $request, $id)
    {
        $mou = Mou::findOrFail($id);

        // Validasi dan update data
        $mou->update($request->all());

        return redirect()->route('mou.index')->with('success', 'Data berhasil diupdate.');
    }


    public function destroy($id)
    {
        $mou = Mou::findOrFail($id);
        $mou->delete();

        return redirect()->route('mou.index')->with('success', 'Data berhasil dihapus.');
    }

    public function destroy_all()
    {
        MOU::truncate();

        return redirect()->route('mou.index')->with('success', 'Semua data berhasil dihapus.');
    }
}
