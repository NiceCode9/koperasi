<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $table = 'nasabah';
    protected $fillable = [
        'user_id',
        'foto',
        'nama_lengkap',
        'nik',
        'telephone',
        'email',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'alamat_kantor_usaha',
        'agama',
        'rt_rw',
        'dsn',
        'ds',
        'kec',
        'kab',
        'kode_pos',
        'status_perkawinan',
    ];

    public function akun()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
