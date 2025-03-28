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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabah')->onDelete('cascade');
            $table->string('jenis_pengajuan')->nullable();
            $table->string('nominal_pengajuan')->nullable();
            $table->string('nominal_disetujui')->nullable();
            $table->string('angsuran')->nullable();
            $table->string('angsuran_margin')->nullable();
            $table->string('keperluan')->nullable();
            $table->string('jangka_waktu')->nullable();
            $table->string('jaminan')->nullable();
            $table->string('ahli_waris')->nullable();
            $table->string('nama_pemilik_jaminan')->nullable();
            $table->string('ktp')->nullable();
            $table->string('buku_nikah')->nullable();
            $table->string('kk')->nullable();
            $table->string('surat_jaminan')->nullable();
            $table->string('surat_keterangan_usaha')->nullable();
            $table->string('dokumen_pendukung')->nullable();
            $table->string('dokumen_lainnya')->nullable();
            $table->enum('status', ['pending', 'survei', 'accepted', 'rejected'])->default('pending');
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_assesment')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
