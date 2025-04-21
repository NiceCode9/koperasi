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
        Schema::create('angsurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained();
            $table->integer('nomor_angsuran');
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_bayar')->nullable();
            $table->decimal('jumlah_angsuran', 12, 2);
            $table->decimal('denda', 12, 2)->default(0);
            $table->string('status')->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsurans');
    }
};
