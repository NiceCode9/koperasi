<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'nomor_angsuran',
        'tanggal_jatuh_tempo',
        'tanggal_bayar',
        'jumlah_angsuran',
        'total_angsuran',
        'pokok',
        'margin',
        'denda',
        'status',
    ];


    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    public function getStatusLabelAttribute()
    {
        $statuses = [
            'unpaid' => ['label' => 'Belum Bayar', 'class' => 'badge-danger'],
            'paid' => ['label' => 'Lunas', 'class' => 'badge-success'],
            'late' => ['label' => 'Terlambat', 'class' => 'badge-warning'],
        ];

        return $statuses[$this->status] ?? ['label' => 'Unknown', 'class' => 'badge-secondary'];
    }
}
