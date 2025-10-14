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

        // foreach ($data as $item) {
        //     foreach ($fields as $field) {
        //         $item->{$field} = Date::formatFlexible($item->{$field});
        //     }
        // }


        return view('admin.mou.index', compact('mou', 'data'));
    }

    public function export()
    {
        return Excel::download(new MOUExport, 'Data MOU Gupeg SIT Permata.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new MOUImport, $request->file('file'));

        return back()->with('success', 'Data berhasil diimpor!');
    }

    public function uploadProcess(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv', // Sesuaikan dengan kebutuhan
        ]);

        // Contoh: menyimpan file upload ke storage
        $path = $request->file('file')->store('uploads');

        // Jika menggunakan Laravel Excel (opsional)
        Excel::import(new MouImport, $request->file('file'));

        return redirect()->route('mou.upload.process')->with('success', 'Data berhasil diupload.');
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
}
