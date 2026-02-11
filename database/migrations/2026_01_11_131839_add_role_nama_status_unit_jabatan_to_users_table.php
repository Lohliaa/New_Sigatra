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
        Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['admin','guru','staf','kabid','kanit']);
        $table->string('nama_lengkap')->nullable();
        $table->string('status')->nullable();
        $table->string('unit')->nullable();
        $table->string('jabatan')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'nama_lengkap', 'status', 'unit', 'jabatan']);
    });
    }
};
