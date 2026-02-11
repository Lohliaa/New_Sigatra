<?php

namespace App\Http\Controllers;

use App\Models\Form_Penilaian;
use App\Models\Pejabat;
use App\Models\Periode;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Form_PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $form_penilaian = Form_Penilaian::with(['users', 'periode'])
            ->orderBy('id', 'desc')
            ->get();

        return view('form_penilaian_kinerja.index', compact('form_penilaian'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('id', 'name', 'unit', 'status', 'jabatan')
            ->orderBy('name')
            ->get();

        $pejabat = Pejabat::select('id', 'nama', 'jabatan', 'unit', 'status')
            ->orderBy('nama')
            ->get();

        $periodes = Periode::select('id', 'periode', 'tanggal')
            ->orderBy('periode')
            ->get();

        $status  = $users->pluck('status')->unique()->values();
        $unit    = $users->pluck('unit')->unique()->values();
        $jabatan = $users->pluck('jabatan')->unique()->values();

        return view(
            'form_penilaian_kinerja.create',
            compact('users', 'pejabat', 'periodes', 'status', 'unit', 'jabatan')
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'kabit', 'kanit'])) {
            $request->merge([
                'nama' => auth()->user()->name
            ]);
        }

        $validated = $request->validate([
            'persiapan_tugas'        => 'required|integer',
            'pelaksanaan_tugas'      => 'required|integer',
            'supervisor_evelator'    => 'required|integer',
            'layanan_peserta_didik'  => 'required|integer',
            'layanan_orangtua_rekan' => 'required|integer',
            'sholat_berjamaah'       => 'required|integer',
            'baca_quran_harian'      => 'required|integer',
            'hafalan_quran'          => 'required|integer',
            'kehadiran_bpi'          => 'required|integer',
            'kejujuran'              => 'required|integer',
            'tanggung_jawab'         => 'required|integer',
            'interaksi_sosial'       => 'required|integer',
            'selalu_hadir'           => 'required|integer',
            'datang_tepat_waktu'     => 'required|integer',
            'tertib_berseragam'      => 'required|integer',
            'koordinasi_kelembagaan' => 'required|integer',
            'komitmen_kelembagaan'   => 'required|integer',
            'catatan'                => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $total = array_sum($validated);
        $rata_rata = $total / 17;

        Form_Penilaian::create(array_merge(
            $validated,
            [
                'user_id'   => Auth::id(),
                'total'     => $total,
                'rata_rata' => round($rata_rata, 2),
                'status'    => 'submitted',
            ]
        ));

        return redirect()
            ->route('form_penilaian.index')
            ->with('success', 'Penilaian mandiri berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $form_penilaian = Form_Penilaian::findOrFail($id);
        return view('form_penilaian_kinerja.read', compact('form_penilaian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $form_penilaian = Form_Penilaian::findOrFail($id);
        $user = Auth::user();

        // staf & guru tidak boleh edit
        if (in_array($user->role, ['staf', 'guru'])) {
            abort(403);
        }

        // kabid & kanit hanya satu unit
        if (in_array($user->role, ['kabid', 'kanit'])) {
            if ($user->unit !== $form_penilaian->user->unit) {
                abort(403);
            }
        }

        return view('form_penilaian_kinerja.edit', compact('form_penilaian'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $form_penilaian = Form_Penilaian::findOrFail($id);
        $user = Auth::user();

        // staf & guru dilarang update
        if (in_array($user->role, ['staf', 'guru'])) {
            abort(403);
        }

        // kabid & kanit harus satu unit
        if (in_array($user->role, ['kabid', 'kanit'])) {
            if ($user->unit !== $form_penilaian->user->unit) {
                abort(403);
            }
        }

        $validated = $request->validate([
            'persiapan_tugas'        => 'required|integer',
            'pelaksanaan_tugas'      => 'required|integer',
            'supervisor_evelator'    => 'required|integer',
            'layanan_peserta_didik'  => 'required|integer',
            'layanan_orangtua_rekan' => 'required|integer',
            'sholat_berjamaah'       => 'required|integer',
            'baca_quran_harian'      => 'required|integer',
            'hafalan_quran'          => 'required|integer',
            'kehadiran_bpi'          => 'required|integer',
            'kejujuran'              => 'required|integer',
            'tanggung_jawab'         => 'required|integer',
            'interaksi_sosial'       => 'required|integer',
            'selalu_hadir'           => 'required|integer',
            'datang_tepat_waktu'     => 'required|integer',
            'tertib_berseragam'      => 'required|integer',
            'koordinasi_kelembagaan' => 'required|integer',
            'komitmen_kelembagaan'   => 'required|integer',
            'catatan'                => 'nullable|string',
        ]);

        $total = array_sum($validated);
        $rata_rata = $total / 17;

        $form_penilaian->update([
            ...$validated,
            'total'        => $total,
            'rata_rata'    => round($rata_rata, 2),
            'penilai_id'   => $user->id,
            'status'       => 'validated',
            'validated_at' => now(),
        ]);

        return redirect()
            ->route('form_penilaian.index')
            ->with('success', 'Penilaian berhasil divalidasi');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $form_penilaian = Form_Penilaian::findOrFail($id);
        $form_penilaian->delete();

        return redirect()->route('form_penilaian.index')->with('success', 'Data berhasil dihapus.');
    }
}
