<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index()
    {
        $users = Users::orderBy('id', 'asc')->get();
        $data = $users;

        // ambil role unik
        $role = Users::select('role')
            ->distinct()
            ->pluck('role');

        $status = Users::select('status')
            ->distinct()
            ->pluck('status');

        $unit = Users::select('unit')
            ->distinct()
            ->pluck('unit');

        return view('admin.users.index', compact('users', 'data', 'role', 'status', 'unit'));
    }

    /**
     * Display the login view.
     */
    public function create()
    {
        //
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|unique:users,name',
            'email'         => 'nullable|email|unique:users,email',
            'password'      => 'required|min:6',
            'role'          => 'required',
            'nama_lengkap'  => 'required|string',
            'status'        => 'required|string',
            'unit'          => 'required|string',
            'jabatan'       => 'required|string',
        ]);

        Users::create([
            'name'          => $request->name,         
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role'          => $request->role,
            'nama_lengkap'  => $request->nama_lengkap,
            'status'        => $request->status,
            'unit'          => $request->unit,
            'jabatan'       => $request->jabatan,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = Users::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id);

        // 1. Validasi input
        $request->validate([
            'name'          => 'string|unique:users,name,' . $id,
            'email'         => 'email|unique:users,email,' . $id,
            'role'          => 'nullable',
            'nama_lengkap'  => 'string',
            'status'        => 'nullable',
            'unit'          => 'nullable|string',
            'jabatan'       => 'nullable|string',
            'password'      => 'nullable|min:6', // boleh kosong
        ]);

        // 2. Data yang akan diupdate
        $data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'role'          => $request->role,
            'nama_lengkap'  => $request->nama_lengkap,
            'status'        => $request->status,
            'unit'          => $request->unit,
            'jabatan'       => $request->jabatan,
        ];

        // 3. Kalau password diisi, baru diupdate
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 4. Update ke database
        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Data user berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = Users::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Data user berhasil dihapus');
    }
}
