<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'nomor_pengajuan',
        'jenis_pengajuan',
        'nominal_pengajuan',
        'nominal_disetujui',
        'angsuran',
        'angsuran_margin',
        'keperluan',
        'jangka_waktu',
        'jaminan',
        'ahli_waris',
        'nama_pemilik_jaminan',
        'ktp',
        'buku_nikah',
        'kk',
        'surat_jaminan',
        'surat_keterangan_usaha',
        'dokumen_pendukung',
        'dokumen_lainnya',
        'status',
        'tanggal_pengajuan',
        'tanggal_assesment',
        'keterangan',
        'status_pembayaran',
    ];

    protected $casts = [
        'tanggal_jatuh_tempo' => 'date',
        'tanggal_bayar' => 'date',
        'jumlah_angsuran' => 'decimal:2',
        'pokok' => 'decimal:2',
        'margin' => 'decimal:2',
        'denda' => 'decimal:2',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    public function survei()
    {
        return $this->hasOne(Assignment::class, 'pengajuan_id');
    }

    public function angsurans()
    {
        return $this->hasMany(Angsuran::class, 'pengajuan_id');
    }

    public function getTotalAngsuranAttribute()
    {
        return $this->angsurans()->count();
    }

    public function getAngsuranPaidAttribute()
    {
        return $this->angsurans()->where('status', 'paid')->count();
    }

    public function getAngsuranUnpaidAttribute()
    {
        return $this->angsurans()->where('status', '!=', 'paid')->count();
    }

    public function isLunas()
    {
        return $this->status_pembayaran === 'lunas';
    }

    public function getStatusPembayaranLabelAttribute()
    {
        return [
            'lunas' => ['text' => 'LUNAS', 'class' => 'badge-success'],
            'belum_lunas' => ['text' => 'BELUM LUNAS', 'class' => 'badge-warning'],
        ][$this->status_pembayaran] ?? ['text' => 'UNKNOWN', 'class' => 'badge-secondary'];
    }
}
