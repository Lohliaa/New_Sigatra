<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form_penilaian', function (Blueprint $table) {
            $table->id();
            $table->integer('persiapan_tugas')->nullable();
            $table->integer('pelaksanaan_tugas')->nullable();
            $table->integer('supervisor_evelator')->nullable();
            $table->integer('layanan_peserta_didik')->nullable();
            $table->integer('layanan_orangtua_rekan')->nullable();
            $table->integer('sholat_berjemaah')->nullable();
            $table->integer('baca_quran_harian')->nullable();
            $table->integer('hafalan_quran')->nullable();
            $table->integer('kehadiran_bpi')->nullable();
            $table->integer('kejujuran')->nullable();
            $table->integer('tanggung_jawab')->nullable();
            $table->integer('interaksi_sosial')->nullable();
            $table->integer('selalu_hadir')->nullable();
            $table->integer('datang_tepat_waktu')->nullable();
            $table->integer('tertib_berseragam')->nullable();
            $table->integer('koordinasi_kelembagaan')->nullable();
            $table->integer('komitmen_kelembagaan')->nullable();
            $table->float('total')->nullable();
            $table->float('rata_rata')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_penilaian');
    }
};
