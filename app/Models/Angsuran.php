<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $fillable = ['pengajuan_id', 'nomor_angsuran', 'tanggal_jatuh_tempo', 'tanggal_bayar', 'jumlah_angsuran', 'denda', 'status'];


    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}
