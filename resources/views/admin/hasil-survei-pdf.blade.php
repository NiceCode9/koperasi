<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisa Permohonan Pembiayaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            text-decoration: underline;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
        }

        .form-label {
            width: 250px;
            font-weight: normal;
        }

        .form-input {
            flex: 1;
            min-width: 250px;
            border-bottom: 1px dotted #000;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .subsection-title {
            text-decoration: underline;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td {
            padding: 5px;
            vertical-align: top;
        }

        .indent {
            margin-left: 20px;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .signature-box {
            width: 22%;
            text-align: center;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            margin-top: 60px;
        }

        .total-row {
            border-top: 1px solid #000;
            border-bottom: double;
            font-weight: bold;
        }

        .checkbox {
            width: 15px;
            height: 15px;
            border: 1px solid #000;
            display: inline-block;
            margin-right: 5px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>ANALISA PERMOHONAN PEMBIAYAAN</h1>
    </div>

    <div class="form-group">
        <div class="form-label">NAMA</div>
        <div class="form-input">{{ $pengajuan->nasabah->nama_lengkap }}</div>
        <div class="form-label">NO. PENGAJUAN</div>
        <div class="form-input">{{ $pengajuan->nomor_pengajuan }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">ALAMAT</div>
        <div class="form-input">{{ $pengajuan->nasabah->alamat }}</div>
        <div class="form-label">TANGGAL SURVEY</div>
        <div class="form-input">{{ $pengajuan->survei->tanggal_survei }}</div>
    </div>

    <div class="section-title">A. INFORMASI DASAR</div>

    <div class="form-group">
        <div class="form-label">1. Jumlah Plafon Pengajuan</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->nominal_pengajuan, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">2. Kegunaan Dana Pembiayaan</div>
        <div class="form-input">{{ $pengajuan->keperluan }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">3. Jangka Waktu</div>
        <div class="form-input">{{ $pengajuan->jangka_waktu }} Bulan</div>
    </div>

    <div class="form-group">
        <div class="form-label">4. Pekerjaan Pemohon</div>
        <div class="form-input">{{ $pengajuan->nasabah->pekerjaan }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">5. Pekerjaan Sampingan (jika ada)</div>
        <div class="form-input">{{ $pengajuan->survei->pekerjaan_sampingan }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">6. Hubungan Pemohon Dengan BMT</div>
        <div class="form-input">
            <span class="checkbox"
                style="{{ $pengajuan->survei->hubungan_dengan_bmt == 'baru' ? 'background-color: #000;' : '' }}"></span>
            Baru
            <span class="checkbox"
                style="{{ $pengajuan->survei->hubungan_dengan_bmt == 'lama' ? 'background-color: #000;' : '' }}"></span>
            Lama Ke:
            {{ $pengajuan->survei->jumlah_hubungan }}
        </div>
    </div>

    <div class="form-group">
        <div class="form-label">7. Nilai Plafon Tertinggi Yang Pernah Diterima</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->plafon_tertinggi_sebelumnya, 0, ',', '.') }}
        </div>
    </div>

    <div class="form-group">
        <div class="form-label">8. Riwayat Pembayaran Sebelumnya</div>
        <div class="form-input">{{ $pengajuan->survei->riwayat_pembayaran }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">9. No. Rek. Anggota/Tabungan/SISUKA Di BMT</div>
        <div class="form-input">{{ $pengajuan->survei->nomor_rekening_anggota }}</div>
    </div>

    <div class="section-title">B. ANALISA PENGGUNAAN DANA (Jelaskan Penggunaan Dana Dari BMT Secara Detail)</div>
    <div class="form-input" style="min-height: 80px; border: 1px dotted #000; padding: 10px; margin-bottom: 20px;">
        {{ $pengajuan->survei->detail_penggunaan_dana }}
    </div>

    <div class="section-title">C. ANALISA USAHA DAN KEMAMPUAN BAYAR ANGGOTA</div>

    <div class="form-group">
        <div class="form-label">Jenis Usaha Anggota</div>
        <div class="form-input">{{ $pengajuan->survei->jenis_usaha }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">Lama Usaha</div>
        <div class="form-input">{{ $pengajuan->survei->lama_usaha_tahun }} Tahun</div>
    </div>

    <div class="form-group">
        <div class="form-label">Jumlah Tenaga Kerja</div>
        <div class="form-input">{{ $pengajuan->survei->jumlah_tenaga_kerja }} Orang</div>
    </div>

    <div class="form-group">
        <div class="form-label">Sistem Penjualan</div>
        <div class="form-input">
            <span class="checkbox"
                style="{{ $pengajuan->survei->sistem_penjualan == 'tunai' ? 'background-color: #000;' : '' }}"></span>
            Tunai
            <span class="checkbox"
                style="{{ $pengajuan->survei->sistem_penjualan == 'angsuran' ? 'background-color: #000;' : '' }}"></span>
            Angsuran
        </div>
    </div>

    <div class="subsection-title">Asset Usaha/Pribadi Yang Dimiliki</div>

    <div class="form-group">
        <div class="form-label indent">Persediaan Barang Dagangan</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->persediaan_barang, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Asset Rumah/Toko/Sawah/....</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->asset_properti, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Asset Kendaraan</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Motor {{ $pengajuan->survei->jumlah_motor }} unit</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->nilai_motor, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Mobil {{ $pengajuan->survei->jumlah_mobil }} unit</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->nilai_mobil, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Lainnya</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->asset_lainnya, 0, ',', '.') }}</div>
    </div>

    <div class="form-group total-row">
        <div class="form-label indent">Total</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->total_asset, 0, ',', '.') }}</div>
    </div>

    <div class="subsection-title">Kewajiban Yang Ditanggung</div>

    <div class="form-group">
        <div class="form-label indent">Hutang Bank</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->hutang_bank, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Hutang Dagang</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->hutang_dagang, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Modal Sendiri</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->modal_sendiri, 0, ',', '.') }}</div>
    </div>

    <div class="form-group total-row">
        <div class="form-label indent">Total</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->total_kewajiban_modal, 0, ',', '.') }}</div>
    </div>

    <div class="subsection-title">Kondisi Usaha</div>

    <div class="form-group">
        <div class="form-label">Trend Penjualan Selama 3 Bulan Terakhir</div>
        <div class="form-input">{{ $pengajuan->survei->trend_penjualan_3bulan }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">Kondisi Usaha Menurut Pengamatan AO</div>
    </div>

    <div class="form-group">
        <div class="form-label">1. Penerimaan Rata-rata dalam satu bulan</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">a. Pendapatan dari usaha</div>
    </div>

    <div class="form-group">
        <div class="form-label indent indent">Omset Penjualan/....</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->omset_bulanan, 0, ',', '.') }}</div>
    </div>

    <div class="form-group" style="font-weight: bold;">
        <div class="form-label indent indent">Total Omset</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->omset_bulanan, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent indent">Biaya Bahan Baku/Belanja</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->biaya_bahan, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent indent">Biaya Tenaga Kerja</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->biaya_tenaga_kerja, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent indent">Biaya Lainnya</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->biaya_lainnya, 0, ',', '.') }}</div>
    </div>

    <div class="form-group" style="font-weight: bold;">
        <div class="form-label indent indent">Jumlah Biaya</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->total_biaya, 0, ',', '.') }}</div>
    </div>

    <div class="form-group" style="font-weight: bold;">
        <div class="form-label indent indent">Pendapatan Usaha/bulan</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->pendapatan_usaha_bulanan, 0, ',', '.') }}
        </div>
    </div>

    <div class="form-group">
        <div class="form-label indent">b. Gaji Pemohon (Jika Ada)</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->gaji_pemohon, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">c. Gaji Suami/Istri (Jika Ada)</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->gaji_pasangan, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">d. Pendapatan Lain (Jika Ada)</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->pendapatan_lain, 0, ',', '.') }}</div>
    </div>

    <div class="form-group" style="font-weight: bold;">
        <div class="form-label indent indent">Jumlah Pendapatan</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->total_pendapatan, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">2. Pengeluaran rata-rata dalam satu bulan</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">a. Kebutuhan Pokok</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->kebutuhan_pokok, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">b. Pendidikan</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->biaya_pendidikan, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">c. Kebutuhan Lainnya</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->pengeluaran_lainnya, 0, ',', '.') }}</div>
    </div>

    <div class="form-group" style="font-weight: bold;">
        <div class="form-label indent">Jumlah Pengeluaran Rutin</div>
        <div class="form-input">Rp. {{ number_format($pengajuan->survei->total_pengeluaran_rutin, 0, ',', '.') }}
        </div>
    </div>

    {{-- <div class="form-group" style="font-weight: bold;">
        <div class="form-label indent">Selisih Dana Kebutuhan</div>
        <div class="form-input">Rp. {{ $selisih_dana }}</div>
    </div>

    <div class="form-group" style="font-weight: bold;">
        <div class="form-label indent">Kemampuan Bayar (60 -- 70 %)</div>
        <div class="form-input">Rp. {{ $kemampuan_bayar }}/Bulan</div>
    </div> --}}

    <div class="section-title">D. ANALISA INFORMASI KARAKTER ANGGOTA</div>

    <div class="form-group">
        <div class="form-label">Sumber Informasi</div>
        <div class="form-input">{{ $pengajuan->survei->sumber_informasi_karakter }}</div>
    </div>
    <div class="form-group">
        <div class="form-input">{{ $pengajuan->survei->analisa_karakter }}</div>
    </div>

    <div class="section-title">E. ANALISA JAMINAN</div>

    <div class="form-group">
        <div class="form-label">1. JENIS JAMINAN</div>
    </div>

    <table>
        <tr>
            <td width="30%">a. Jenis Kendaraan</td>
            <td width="20%">: {{ $pengajuan->survei->jenis_kendaraan }}</td>
            <td width="30%">Merk/Type</td>
            <td width="20%">: {{ $pengajuan->survei->merk_tipe }}</td>
        </tr>
        <tr>
            <td>b. Nomor Polisi</td>
            <td>: {{ $pengajuan->survei->nomor_polisi }}</td>
            <td>Thn Pembuatan</td>
            <td>: {{ $pengajuan->survei->tahun_pembuatan }}</td>
        </tr>
        <tr>
            <td>c. Atas Nama</td>
            <td>: {{ $pengajuan->survei->nama_pemilik }}</td>
            <td>Nomor Rangka</td>
            <td>: {{ $pengajuan->survei->nomor_rangka }}</td>
        </tr>
        <tr>
            <td>d. Alamat</td>
            <td>: {{ $pengajuan->survei->alamat_pemilik }}</td>
            <td>Nomor Mesin</td>
            <td>: {{ $pengajuan->survei->nomor_mesin }}</td>
        </tr>
        <tr>
            <td>e. Hub. Dengan Angg.</td>
            <td>: {{ $pengajuan->survei->hubungan_dengan_anggota }}</td>
            <td>Nomor BPKB</td>
            <td>: {{ $pengajuan->survei->nomor_bpkb }}</td>
        </tr>
    </table>

    <div class="form-group">
        <div class="form-label">Bukti Kepemilikan:</div>
        <div class="form-input">
            <span class="checkbox"
                style="{{ $pengajuan->survei->bukti_kepemilikan == 'Ada' ? 'background-color: #000;' : '' }}"></span>
            Ada
            <span class="checkbox"
                style="{{ $pengajuan->survei->bukti_kepemilikan == 'Kwitansi Jual Beli' ? 'background-color: #000;' : '' }}"></span>
            Kwitansi Jual Beli
            <span class="checkbox"
                style="{{ $pengajuan->survei->bukti_kepemilikan == 'Surat Keterangan' ? 'background-color: #000;' : '' }}"></span>
            Surat Keterangan
            <span class="checkbox"
                style="{{ $pengajuan->survei->bukti_kepemilikan == 'Tidak Ada' ? 'background-color: #000;' : '' }}"></span>
            Tidak Ada
        </div>
    </div>

    <div class="form-group">
        <div class="form-label">Harga Pasaran</div>
        <div class="form-input">: Rp. {{ number_format($pengajuan->survei->harga_pasaran_kendaraan, 0, ',', '.') }}
        </div>
        <div class="form-label">Nilai Taksasi BMT</div>
        <div class="form-input">: Rp. {{ number_format($pengajuan->survei->nilai_taksasi_kendaraan, 0, ',', '.') }}
        </div>
    </div>

    <div class="form-group">
        <div class="form-label">Informasi Kondisi Jaminan</div>
        <div class="form-input">: {{ $pengajuan->survei->informasi_kaminan_kendaraan }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">2. JENIS JAMINAN</div>
    </div>

    <table>
        <tr>
            <td width="50%">a. Jenis SHM/SHGU/SHGB</td>
            <td width="50%">: {{ $pengajuan->survei->jenis_sertifikat }}</td>
        </tr>
        <tr>
            <td>b. Nomor SHM/SHGU/SHGB</td>
            <td>: {{ $pengajuan->survei->nomor_sertifikat }}</td>
        </tr>
        <tr>
            <td>c. Atas Nama</td>
            <td>: {{ $pengajuan->survei->pemilik_sertifikat }}</td>
        </tr>
        <tr>
            <td>d. Luas Tanah/Luas Bangunan</td>
            <td>: {{ $pengajuan->survei->luas_tanah_bangunan }}</td>
        </tr>
        <tr>
            <td>e. Tanggal dan No. Ukur</td>
            <td>: {{ $pengajuan->survei->nomor_tanggal_ukur }}</td>
        </tr>
        <tr>
            <td>f. Hubungan Pemilik</td>
            <td>: {{ $pengajuan->survei->hubungan_pemilik }}</td>
        </tr>
        <tr>
            <td>g. Harga Pasar</td>
            <td>: Rp. {{ number_format($pengajuan->survei->harga_pasar_tanah, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>h. Nilai Taksasi BMT</td>
            <td>: Rp. {{ number_format($pengajuan->survei->nilai_taksasi_tanah, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>i. Informasi Kondisi Jaminan</td>
            <td>: {{ $pengajuan->survei->kondisi_jaminan_tanah }}</td>
        </tr>
    </table>

    <div class="section-title" style="text-align: center; margin-top: 30px;">PERSETUJUAN PENGAJUAN PEMBIAYAAN</div>

    <p>Berdasarkan analisa yang telah kami lakukan dengan seksama, maka berdasarkan pertimbangan kami bahwa anggota
        layak untuk mendapatkan fasilitas pembiayaan:</p>

    <div class="form-group">
        <div class="form-label">Besar Plafon</div>
        <div class="form-input">: Rp. {{ number_format($pengajuan->survei->plafon_disetujui, 0, ',', '.') }}</div>
        <div class="form-label">Kegunaan</div>
        <div class="form-input">: {{ $pengajuan->keperluan }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">Jangka Waktu</div>
        <div class="form-input">: {{ $pengajuan->survei->jangka_waktu_disetujui ?? '' }} Bulan</div>
        <div class="form-label">Sistem Pembayaran</div>
        <div class="form-input">:
            <span class="checkbox"
                style="{{ $pengajuan->survei->sistem_pembayaran == 'bulanan' ? 'background-color: #000;' : '' }}"></span>
            Bulanan/
            <span class="checkbox"
                style="{{ $pengajuan->survei->sistem_pembayaran == 'jatuh_tempo' ? 'background-color: #000;' : '' }}"></span>
            Jatuh Tempo
        </div>
    </div>

    <div class="form-group">
        <div class="form-label">Akad Pembiayaan</div>
        <div class="form-input">:
            <span class="checkbox"
                style="{{ $pengajuan->survei->akad_pembiayaan == 'mudharabah' ? 'background-color: #000;' : '' }}"></span>
            MUDHARABAH/
            <span class="checkbox"
                style="{{ $pengajuan->survei->akad_pembiayaan == 'murabahah' ? 'background-color: #000;' : '' }}"></span>
            MURABAHAH/
            <span class="checkbox"
                style="{{ $pengajuan->survei->akad_pembiayaan == 'musayarakah' ? 'background-color: #000;' : '' }}"></span>
            MUSYARAKAH/
            <span class="checkbox"
                style="{{ $pengajuan->survei->akad_pembiayaan == 'multi_jasa' ? 'background-color: #000;' : '' }}"></span>
            MULTI
            JASA/
            <span class="checkbox"
                style="{{ $pengajuan->survei->akad_pembiayaan == 'lainnya' ? 'background-color: #000;' : '' }}"></span>
            {{ $pengajuan->survei->jenis_akad_lainnya }}
        </div>
    </div>

    <div class="form-group">
        <div class="form-label">Harga Jual BMT</div>
        <div class="form-input">: Rp. {{ number_format($pengajuan->survei->harga_jual_bmt, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">Nisbah Bagi Hasil BMT</div>
        <div class="form-input">: {{ $pengajuan->survei->presentase_bagi_hasil }} % Setara pendapatan/bulan Rp.
            {{ number_format($pengajuan->survei->pendapatan_setara_sebulan, 0, ',', '.') }}</div>
    </div>
    </div>

    <div class="form-group">
        <div class="form-label">Jumlah Angsuran Perbulan</div>
        <div class="form-input">: Rp. {{ number_format($pengajuan->survei->angsuran_bulanan, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label">Biaya-biaya:</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Administrasi</div>
        <div class="form-input">: Rp. {{ number_format($pengajuan->survei->biaya_administrasi, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Notaris</div>
        <div class="form-input">: Rp. {{ number_format($pengajuan->survei->biaya_notaris, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Materai</div>
        <div class="form-input">: Rp. {{ number_format($pengajuan->survei->biaya_materai, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Asuransi</div>
        <div class="form-input">: Rp. {{ number_format($pengajuan->survei->biaya_asuransi, 0, ',', '.') }}</div>
    </div>

    <div class="form-group">
        <div class="form-label indent">Lain-lain</div>
        <div class="form-input">: Rp. {{ number_format($pengajuan->survei->biaya_lain, 0, ',', '.') }}</div>
    </div>

    <div class="form-group" style="font-weight: bold;">
        <div class="form-label indent">TOTAL BIAYA-BIAYA</div>
        <div class="form-input">: Rp. {{ number_format($pengajuan->survei->total_biaya_admin, 0, ',', '.') }}</div>
    </div>

    <div class="section-title" style="text-align: center; margin-top: 30px;">KEPUTUSAN ATAS PENGAJUAN PEMBIAYAAN</div>

    <div class="signatures">
        <div class="signature-box">
            <p>Diajukan,</p>
            <p>(Account Officer)</p>
            <div class="signature-line"></div>
            <p>{{ $pengajuan->survei->marketing->name }}</p>
        </div>

        <div class="signature-box">
            <p>Diperiksa,</p>
            <p>Manager</p>
            <div class="signature-line"></div>
            <p>{{ $pengajuan->survei->manager->name ?? '' }}</p>
        </div>

        <div class="signature-box">
            <p>Disetujui,</p>
            <p>Ketua Umum</p>
            <div class="signature-line"></div>
            <p></p>
        </div>

        <div class="signature-box">
            <p>Mengetahui,</p>
            <p>Pengurus</p>
            <div class="signature-line"></div>
            <p></p>
        </div>
    </div>
</body>

</html>
