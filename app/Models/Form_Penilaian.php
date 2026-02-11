<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form_Penilaian extends Model
{
    use HasFactory;
    protected $table = "form_penilaian";
    protected $primaryKey = 'id';
    protected $fillable = [
        'persiapan_tugas',
        'pelaksanaan_tugas',
        'supervisor_evelator',
        'layanan_peserta_didik',
        'layanan_orangtua_rekan',
        'sholat_berjamaah',
        'baca_quran_harian',
        'hafalan_quran',
        'kehadiran_bpi',
        'kejujuran',
        'tanggung_jawab',
        'interaksi_sosial',
        'selalu_hadir',
        'datang_tepat_waktu',
        'tertib_berseragam',
        'koordinasi_kelembagaan',
        'komitmen_kelembagaan',
        'total',
        'rata-rata',
        'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
