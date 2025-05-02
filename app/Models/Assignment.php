<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'tanggal_survei',
        'jumlah_plafon',
        'pekerjaan_sampingan',
        'hubungan_dengan_bmt',
        'jumlah_hubungan',
        'plafon_tertinggi_sebelumnya',
        'riwayat_pembayaran',
        'nomor_rekening_anggota',
        'detail_penggunaan_dana',
        'jenis_usaha',
        'lama_usaha_tahun',
        'jumlah_tenaga_kerja',
        'sistem_penjualan',
        'persediaan_barang',
        'aset_properti',
        'jumlah_motor',
        'nilai_motor',
        'jumlah_mobil',
        'nilai_mobil',
        'aset_lainnya',
        'total_aset',
        'hutang_bank',
        'hutang_dagang',
        'modal_sendiri',
        'total_kewajiban_modal',
        'tren_penjualan_3bulan',
        'omset_bulanan',
        'biaya_bahan',
        'biaya_tenaga_kerja',
        'biaya_lainnya',
        'total_biaya',
        'pendapatan_usaha_bulanan',
        'gaji_pemohon',
        'gaji_pasangan',
        'pendapatan_lain',
        'total_pendapatan',
        'kebutuhan_pokok',
        'biaya_pendidikan',
        'pengeluaran_lainnya',
        'total_pengeluaran_rutin',
        'selisih_dana',
        'kemampuan_bayar',
        'sumber_informasi_karakter',
        'analisa_karakter',
        'jenis_kendaraan',
        'merk_tipe',
        'nomor_polisi',
        'tahun_pembuatan',
        'nama_pemilik',
        'nomor_rangka',
        'alamat_pemilik',
        'nomor_mesin',
        'hubungan_dengan_anggota',
        'nomor_bpkb',
        'bukti_kepemilikan',
        'harga_pasar_kendaraan',
        'nilai_taksasi_kendaraan',
        'kondisi_jaminan_kendaraan',
        'jenis_sertifikat',
        'nomor_sertifikat',
        'pemilik_sertifikat',
        'luas_tanah_bangunan',
        'nomor_tanggal_ukur',
        'hubungan_pemilik',
        'harga_pasar_tanah',
        'nilai_taksasi_tanah',
        'kondisi_jaminan_tanah',
        'plafon_disetujui',
        'jangka_waktu_disetujui',
        'sistem_pembayaran',
        'akad_pembiayaan',
        'jenis_akad_lainnya',
        'harga_jual_bmt',
        'persentase_bagi_hasil',
        'pendapatan_setara_bulanan',
        'angsuran_bulanan',
        'biaya_administrasi',
        'biaya_notaris',
        'biaya_materai',
        'biaya_asuransi',
        'biaya_lain',
        'total_biaya_admin',
        'marketing_id',
        'manager_id',
        'status_aplikasi'
    ];

    protected $casts = [
        'tanggal_survei' => 'date',
        'jumlah_plafon' => 'decimal:2',
        'plafon_tertinggi_sebelumnya' => 'decimal:2',
        'persediaan_barang' => 'decimal:2',
        'aset_properti' => 'decimal:2',
        'nilai_motor' => 'decimal:2',
        'nilai_mobil' => 'decimal:2',
        'aset_lainnya' => 'decimal:2',
        'total_aset' => 'decimal:2',
        'hutang_bank' => 'decimal:2',
        'hutang_dagang' => 'decimal:2',
        'modal_sendiri' => 'decimal:2',
        'total_kewajiban_modal' => 'decimal:2',
        'omset_bulanan' => 'decimal:2',
        'biaya_bahan' => 'decimal:2',
        'biaya_tenaga_kerja' => 'decimal:2',
        'biaya_lainnya' => 'decimal:2',
        'total_biaya' => 'decimal:2',
        'pendapatan_usaha_bulanan' => 'decimal:2',
        'gaji_pemohon' => 'decimal:2',
        'gaji_pasangan' => 'decimal:2',
        'pendapatan_lain' => 'decimal:2',
        'total_pendapatan' => 'decimal:2',
        'kebutuhan_pokok' => 'decimal:2',
        'biaya_pendidikan' => 'decimal:2',
        'pengeluaran_lainnya' => 'decimal:2',
        'total_pengeluaran_rutin' => 'decimal:2',
        'selisih_dana' => 'decimal:2',
        'harga_pasar_kendaraan' => 'decimal:2',
        'nilai_taksasi_kendaraan' => 'decimal:2',
        'harga_pasar_tanah' => 'decimal:2',
        'nilai_taksasi_tanah' => 'decimal:2',
        'plafon_disetujui' => 'decimal:2',
        'harga_jual_bmt' => 'decimal:2',
        'persentase_bagi_hasil' => 'decimal:2',
        'pendapatan_setara_bulanan' => 'decimal:2',
        'angsuran_bulanan' => 'decimal:2',
        'biaya_administrasi' => 'decimal:2',
        'biaya_notaris' => 'decimal:2',
        'biaya_materai' => 'decimal:2',
        'biaya_asuransi' => 'decimal:2',
        'biaya_lain' => 'decimal:2',
        'total_biaya_admin' => 'decimal:2',
        'bukti_kepemilikan' => 'boolean',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
    public function marketing()
    {
        return $this->belongsTo(User::class, 'marketing_id');
    }
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function getStatusLabelAttribute()
    {
        switch ($this->status_aplikasi) {
            case 'pending':
                return 'Pending';
            case 'approved':
                return 'Approved';
            case 'rejected':
                return 'Rejected';
            default:
                return 'Unknown';
        }
    }
    public function getStatusClassAttribute()
    {
        switch ($this->status_aplikasi) {
            case 'pending':
                return 'badge badge-warning';
            case 'approved':
                return 'badge badge-success';
            case 'rejected':
                return 'badge badge-danger';
            default:
                return 'badge badge-secondary';
        }
    }
    public function getStatusColorAttribute()
    {
        switch ($this->status_aplikasi) {
            case 'pending':
                return 'text-warning';
            case 'approved':
                return 'text-success';
            case 'rejected':
                return 'text-danger';
            default:
                return 'text-secondary';
        }
    }
}
