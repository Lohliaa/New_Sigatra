<?php

namespace App\Http\Controllers;

use App\Exports\SKExport;
use App\Models\SK;
use Illuminate\Http\Request;
use App\Helpers\DateHelper;
use App\Imports\SKImport;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;

class SKController extends Controller
{

    public function index()
    {
        $sk = SK::orderBy('id', 'asc')->get();
        $data = $sk;

        $fields = ['tanggal_lahir', 'tanggal_mulai', 'tanggal_akhir', 'tanggal_ditetapkan'];

        return view('admin.sk.index', compact('sk', 'data'));
    }

    public function export()
    {
        return Excel::download(new SKExport, 'Data SK Gupeg SIT Permata.xlsx');
    }

    public function upload()
    {
        return view('sk.upload');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new SKImport, $request->file('file'));

        return back()->with('success', 'Data berhasil diimpor!');
    }

    public function uploadProcess(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Jalankan import
        Excel::import(new SKImport, $request->file('file'));

        return redirect()->route('sk.index')->with('success', 'Data SK berhasil diupload.');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sk = SK::findOrFail($id);
        return view('admin.sk.read', compact('sk'));
    }

    public function edit($id)
    {
        $sk = SK::findOrFail($id);
        return view('admin.sk.edit', compact('sk'));
    }

    public function update(Request $request, $id)
    {
        $sk = SK::findOrFail($id);

        // Validasi dan update data
        $sk->update($request->all());

        return redirect()->route('sk.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $sk = SK::findOrFail($id);
        $sk->delete();

        return redirect()->route('sk.index')->with('success', 'Data berhasil dihapus.');
    }

    public function destroy_all()
    {
        SK::truncate();

        return redirect()->route('sk.index')->with('success', 'Semua data berhasil dihapus.');
    }
}
