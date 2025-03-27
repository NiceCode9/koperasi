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
        Schema::create('nasabah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->string('nama_lengkap');
            $table->string('nik')->unique();
            $table->string('telephone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('pekerjaan')->nullable();
            $table->string('alamat_kantor_usaha')->nullable();
            $table->string('agama')->nullable();
            $table->string('rt_rw')->nullable();
            $table->string('dsn')->nullable();
            $table->string('ds')->nullable();
            $table->string('kec')->nullable();
            $table->string('kab')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah');
    }
};
