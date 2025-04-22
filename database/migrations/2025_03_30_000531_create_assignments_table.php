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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuans')->onDelete('cascade');
            $table->date('tanggal_survei');

            // Informasi Dasar
            $table->decimal('jumlah_plafon', 15, 2);
            // $table->text('tujuan_pembiayaan');
            // $table->integer('jangka_waktu_bulan');
            // $table->string('pekerjaan_pemohon');
            $table->string('pekerjaan_sampingan')->nullable();
            $table->enum('hubungan_dengan_bmt', ['baru', 'lama'])->default('baru');
            $table->integer('jumlah_hubungan')->nullable();
            $table->decimal('plafon_tertinggi_sebelumnya', 15, 2)->nullable();
            $table->text('riwayat_pembayaran')->nullable();
            $table->string('nomor_rekening_anggota')->nullable();

            // Analisa Penggunaan Dana
            $table->text('detail_penggunaan_dana')->nullable();

            // Analisa Usaha dan Kemampuan Bayar
            $table->string('jenis_usaha')->nullable();
            $table->string('lama_usaha_tahun')->nullable();
            $table->integer('jumlah_tenaga_kerja')->nullable();
            $table->enum('sistem_penjualan', ['tunai', 'angsuran', 'keduanya'])->default('tunai');

            // Asset Usaha/Pribadi
            $table->decimal('persediaan_barang', 15, 2)->nullable();
            $table->decimal('aset_properti', 15, 2)->nullable();
            $table->integer('jumlah_motor')->nullable();
            $table->decimal('nilai_motor', 15, 2)->nullable();
            $table->integer('jumlah_mobil')->nullable();
            $table->decimal('nilai_mobil', 15, 2)->nullable();
            $table->decimal('aset_lainnya', 15, 2)->nullable();
            $table->decimal('total_aset', 15, 2)->nullable();

            // Kewajiban yang Ditanggung
            $table->decimal('hutang_bank', 15, 2)->nullable();
            $table->decimal('hutang_dagang', 15, 2)->nullable();
            $table->decimal('modal_sendiri', 15, 2)->nullable();
            $table->decimal('total_kewajiban_modal', 15, 2)->nullable();

            // Kondisi Usaha
            $table->text('tren_penjualan_3bulan')->nullable();

            // Penerimaan bulanan
            $table->decimal('omset_bulanan', 15, 2)->nullable();
            $table->decimal('biaya_bahan', 15, 2)->nullable();
            $table->decimal('biaya_tenaga_kerja', 15, 2)->nullable();
            $table->decimal('biaya_lainnya', 15, 2)->nullable();
            $table->decimal('total_biaya', 15, 2)->nullable();
            $table->decimal('pendapatan_usaha_bulanan', 15, 2)->nullable();
            $table->decimal('gaji_pemohon', 15, 2)->nullable();
            $table->decimal('gaji_pasangan', 15, 2)->nullable();
            $table->decimal('pendapatan_lain', 15, 2)->nullable();
            $table->decimal('total_pendapatan', 15, 2);

            // Pengeluaran bulanan
            $table->decimal('kebutuhan_pokok', 15, 2);
            $table->decimal('biaya_pendidikan', 15, 2)->nullable();
            $table->decimal('pengeluaran_lainnya', 15, 2)->nullable();
            $table->decimal('total_pengeluaran_rutin', 15, 2)->nullable();
            $table->decimal('selisih_dana', 15, 2)->nullable();
            $table->enum('kemampuan_bayar', ['Baik', 'Cukup', 'Kurang'])->default('Baik');

            // Analisa Karakter
            $table->text('sumber_informasi_karakter')->nullable();
            $table->text('analisa_karakter')->nullable();

            // Analisa Jaminan
            // Jaminan Kendaraan
            $table->string('jenis_kendaraan')->nullable(); // Jenis kendaraan
            $table->string('merk_tipe')->nullable(); // Merk/Type
            $table->string('nomor_polisi')->nullable(); // Nomor polisi
            $table->year('tahun_pembuatan')->nullable(); // Tahun pembuatan
            $table->string('nama_pemilik')->nullable(); // Atas nama
            $table->string('nomor_rangka')->nullable(); // Nomor rangka
            $table->text('alamat_pemilik')->nullable(); // Alamat
            $table->string('nomor_mesin')->nullable(); // Nomor mesin
            $table->string('hubungan_dengan_anggota')->nullable(); // Hubungan dengan anggota
            $table->string('nomor_bpkb')->nullable(); // Nomor BPKB
            // $table->boolean('bukti_kepemilikan')->nullable(); // Bukti kepemilikan
            $table->enum('bukti_kepemilikan', ['Ada', 'Kwitansi Jual Beli', 'Surat Keterangan', 'Tidak Ada'])->nullable(); // Bukti kepemilikan
            $table->decimal('harga_pasar_kendaraan', 15, 2)->nullable(); // Harga pasaran
            $table->decimal('nilai_taksasi_kendaraan', 15, 2)->nullable(); // Nilai taksasi BMT
            $table->text('kondisi_jaminan_kendaraan')->nullable(); // Informasi kondisi jaminan

            // Jaminan Sertifikat
            $table->string('jenis_sertifikat')->nullable(); // Jenis SHM/SHGU/SHGB
            $table->string('nomor_sertifikat')->nullable(); // Nomor sertifikat
            $table->string('pemilik_sertifikat')->nullable(); // Atas nama
            $table->string('luas_tanah_bangunan')->nullable(); // Luas tanah/bangunan
            $table->string('nomor_tanggal_ukur')->nullable(); // Tanggal dan no ukur
            $table->string('hubungan_pemilik')->nullable(); // Hubungan pemilik
            $table->decimal('harga_pasar_tanah', 15, 2)->nullable(); // Harga pasar
            $table->decimal('nilai_taksasi_tanah', 15, 2)->nullable(); // Nilai taksasi BMT
            $table->text('kondisi_jaminan_tanah')->nullable(); // Informasi kondisi jaminan

            // Persetujuan
            $table->decimal('plafon_disetujui', 15, 2)->nullable(); // Besar plafon disetujui
            // $table->text('tujuan_disetujui')->nullable(); // Kegunaan yang disetujui
            $table->integer('jangka_waktu_disetujui')->nullable(); // Jangka waktu disetujui
            $table->enum('sistem_pembayaran', ['bulanan', 'jatuh_tempo'])->nullable(); // Sistem pembayaran
            $table->enum('akad_pembiayaan', ['mudharabah', 'murabahah', 'musyarakah', 'multi_jasa', 'lainnya'])->nullable(); // Akad pembiayaan
            $table->string('jenis_akad_lainnya')->nullable(); // Jenis akad lainnya
            $table->decimal('harga_jual_bmt', 15, 2)->nullable(); // Harga jual BMT
            $table->decimal('persentase_bagi_hasil', 5, 2)->nullable(); // Nisbah bagi hasil BMT
            $table->decimal('pendapatan_setara_bulanan', 15, 2)->nullable(); // Setara pendapatan/bulan
            $table->decimal('angsuran_bulanan', 15, 2)->nullable(); // Jumlah angsuran per bulan

            // Biaya-biaya
            $table->decimal('biaya_administrasi', 15, 2)->nullable(); // Administrasi
            $table->decimal('biaya_notaris', 15, 2)->nullable(); // Notaris
            $table->decimal('biaya_materai', 15, 2)->nullable(); // Materai
            $table->decimal('biaya_asuransi', 15, 2)->nullable(); // Asuransi
            $table->decimal('biaya_lain', 15, 2)->nullable(); // Lain-lain
            $table->decimal('total_biaya_admin', 15, 2)->nullable(); // Total biaya

            // Status Persetujuan
            $table->foreignId('marketing_id')->nullable()->constrained('users'); // AO
            $table->foreignId('manager_id')->nullable()->constrained('users'); // Manager
            // $table->foreignId('ketua_id')->nullable()->constrained('users'); // Ketua Umum
            // $table->foreignId('pengurus_id')->nullable()->constrained('users'); // Pengurus
            $table->enum('status_aplikasi', ['diajukan', 'diperiksa', 'disetujui', 'ditolak'])->default('diajukan'); // Status aplikasi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
