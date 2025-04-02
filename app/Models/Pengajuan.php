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
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    public function survei()
    {
        return $this->hasOne(Assignment::class, 'pengajuan_id');
    }
}
