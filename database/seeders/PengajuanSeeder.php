<?php

namespace Database\Seeders;

use App\Models\Angsuran;
use App\Models\Assignment;
use App\Models\Nasabah;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PengajuanSeeder extends Seeder
{
    // Konfigurasi
    const MIN_LOAN = 5000000;
    const MAX_LOAN = 50000000;
    const MIN_TENOR = 3;
    const MAX_TENOR = 36;
    const APPROVAL_RATE = 0.9; // 90% dari pengajuan
    const MIN_MARGIN = 5;
    const MAX_MARGIN = 15;

    public function run()
    {
        // Ambil atau buat nasabah contoh
        $nasabahs = Nasabah::all();

        if ($nasabahs->isEmpty()) {
            $nasabahs = Nasabah::factory()->count(5)->create();
            $this->command->info('Created 5 nasabah samples');
        }

        $this->command->info('Creating pengajuan with assignments and angsurans...');

        $nasabahs->each(function ($nasabah) {
            $jumlahPengajuan = rand(2, 4); // 2-4 pengajuan per nasabah

            for ($i = 0; $i < $jumlahPengajuan; $i++) {
                $pengajuan = $this->createPengajuan($nasabah, $i);
                $assignment = $this->createAssignment($pengajuan);
                $this->createAngsurans($pengajuan, $assignment);
            }
        });

        $this->command->info('Successfully created data for ' . $nasabahs->count() . ' nasabah');
    }

    private function createPengajuan($nasabah, $index)
    {
        return Pengajuan::create([
            'nasabah_id' => $nasabah->id,
            'nomor_pengajuan' => 'PGJ-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5)),
            'jenis_pengajuan' => 'Murabahah',
            'nominal_pengajuan' => rand(self::MIN_LOAN, self::MAX_LOAN),
            'keperluan' => $this->getRandomKeperluan(),
            'jangka_waktu' => rand(self::MIN_TENOR, self::MAX_TENOR),
            'jaminan' => $this->getRandomJaminan(),
            'ahli_waris' => $this->getRandomNama(),
            'nama_pemilik_jaminan' => $this->getRandomNama(),
            'status' => 'survei',
            'tanggal_pengajuan' => Carbon::now()->subDays(rand(1, 30)),
            // Dokumen dummy
            'ktp' => 'ktp_' . Str::random(10) . '.jpg',
            'buku_nikah' => 'buku_nikah_' . Str::random(10) . '.jpg',
            'kk' => 'kk_' . Str::random(10) . '.jpg',
            'surat_jaminan' => 'surat_jaminan_' . Str::random(10) . '.pdf',
        ]);
    }

    private function createAssignment($pengajuan)
    {
        $plafon = $pengajuan->nominal_pengajuan * self::APPROVAL_RATE;
        $margin = rand(self::MIN_MARGIN, self::MAX_MARGIN);

        return Assignment::create([
            'pengajuan_id' => $pengajuan->id,
            'jenis_usaha' => $this->getRandomUsaha(),
            'omset_bulanan' => rand(5000000, 20000000),
            'total_aset' => rand(10000000, 500000000),
            'kebutuhan_pokok' => rand(10000000, 500000000),
            'total_pendapatan' => rand(10000000, 500000000),
            // 'total_angsuran' => rand(10000000, 500000000),
            'kemampuan_bayar' => ['Baik', 'Cukup', 'Kurang'][rand(0, 2)],
            'tanggal_survei' => $pengajuan->tanggal_pengajuan->addDays(rand(1, 3)),
            'jumlah_plafon' => $plafon,
            'persentase_bagi_hasil' => $margin,
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
            'jenis_kendaraan' => 'Motor',
            'merk_tipe' => 'Honda Vario 125',
            'tahun_pembuatan' => 2020,
            'bukti_kepemilikan' => 'Ada',
            'plafon_disetujui' => $plafon,
            'jangka_waktu_disetujui' => $pengajuan->jangka_waktu,
            'sistem_pembayaran' => 'bulanan',
            'akad_pembiayaan' => 'murabahah',
            'angsuran_bulanan' => 1000000,
            'marketing_id' => 2,
            'status_aplikasi' => 'diajukan',
        ]);
    }

    private function createAngsurans($pengajuan, $assignment)
    {
        $totalPinjaman = $assignment->plafon_disetujui;
        $margin = $assignment->persentase_bagi_hasil;
        $tenor = $assignment->jangka_waktu_disetujui;

        // Hitung angsuran per bulan
        $totalAngsuran = $totalPinjaman + ($totalPinjaman * $margin / 100);
        $angsuranPerBulan = $totalAngsuran / $tenor;
        $pokokPerBulan = $totalPinjaman / $tenor;
        $marginPerBulan = ($totalPinjaman * $margin / 100) / $tenor;

        // Update pengajuan dengan data angsuran
        $pengajuan->update([
            'nominal_disetujui' => $totalPinjaman,
            'angsuran' => $angsuranPerBulan,
            'angsuran_margin' => $marginPerBulan
        ]);

        // Buat angsuran untuk setiap periode
        for ($i = 1; $i <= $tenor; $i++) {
            $status = ($i <= 3) ? 'paid' : 'unpaid'; // 3 angsuran pertama lunas

            Angsuran::create([
                'pengajuan_id' => $pengajuan->id,
                'nomor_angsuran' => 'ANG-' . $pengajuan->nomor_pengajuan . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'tanggal_jatuh_tempo' => $pengajuan->tanggal_pengajuan->addMonths($i),
                'tanggal_bayar' => $status === 'paid' ? $pengajuan->tanggal_pengajuan->addMonths($i)->subDays(rand(0, 5)) : null,
                'jumlah_angsuran' => $angsuranPerBulan,
                'total_angsuran' => $angsuranPerBulan,
                'pokok' => $pokokPerBulan,
                'margin' => $marginPerBulan,
                'status' => $status,
                'denda' => 0,
            ]);
        }

        $this->command->info('Created ' . $tenor . ' angsuran for pengajuan ' . $pengajuan->nomor_pengajuan);
    }

    // Helper methods
    private function getRandomKeperluan()
    {
        return $this->getRandomItem(['Modal usaha', 'Renovasi rumah', 'Pendidikan anak']);
    }

    private function getRandomJaminan()
    {
        return $this->getRandomItem(['BPKB Motor', 'BPKB Mobil', 'Sertifikat Tanah']);
    }

    private function getRandomNama()
    {
        return $this->getRandomItem(['Ahmad Santoso', 'Budi Setiawan', 'Citra Dewi']);
    }

    private function getRandomUsaha()
    {
        return $this->getRandomItem(['Perdagangan', 'Kuliner', 'Jasa']);
    }

    private function getRandomItem(array $items)
    {
        return $items[array_rand($items)];
    }
}
