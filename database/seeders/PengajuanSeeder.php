<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Pengajuan;
use Illuminate\Database\Seeder;

class PengajuanSeeder extends Seeder
{
    public function run(): void
    {
        Pengajuan::create([
            'nasabah_id' => 1,
            'nomor_pengajuan' => 'PB' . date('Ymd') . '001',
            'jenis_pengajuan' => 'Pembiayaan Murabahah',
            'nominal_pengajuan' => '10000000',
            'keperluan' => 'Modal Usaha',
            'jangka_waktu' => '12',
            'jaminan' => 'BPKB Motor',
            'ahli_waris' => 'Istri',
            'nama_pemilik_jaminan' => 'John Doe',
            'status' => 'pending',
            'tanggal_pengajuan' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ])->each(function ($pengajuan) {
            Assignment::create([
                'pengajuan_id' => $pengajuan->id,
                'tanggal_survei' => now(),
                'jumlah_plafon' => 10000000,
                'pekerjaan_sampingan' => 'Wiraswasta',
                'hubungan_dengan_bmt' => 'baru',
                'jenis_usaha' => 'Toko Kelontong',
                'lama_usaha_tahun' => '2',
                'sistem_penjualan' => 'tunai',
                'persediaan_barang' => 15000000,
                'total_aset' => 25000000,
                'omset_bulanan' => 5000000,
                'total_pendapatan' => 7000000,
                'kebutuhan_pokok' => 3000000,
                'total_pengeluaran_rutin' => 4000000,
                'kemampuan_bayar' => 1000000,
                'jenis_kendaraan' => 'Motor',
                'merk_tipe' => 'Honda Vario 125',
                'tahun_pembuatan' => 2020,
                'bukti_kepemilikan' => 'Ada',
                'plafon_disetujui' => 10000000,
                'jangka_waktu_disetujui' => 12,
                'sistem_pembayaran' => 'bulanan',
                'akad_pembiayaan' => 'murabahah',
                'angsuran_bulanan' => 1000000,
                'marketing_id' => 2,
                'status_aplikasi' => 'diajukan',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
