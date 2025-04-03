<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Analisa Permohonan Pembiayaan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <h1 class="text-center mb-4 text-primary">ANALISA PERMOHONAN PEMBIAYAAN</h1>

                <form>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            Informasi Dasar
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">NAMA NASABAH</label>
                                    <input type="hidden" value="{{ $pengajuan->id }}" name="pengajuan_id">
                                    <input type="text" class="form-control" name="nama_nasabah"
                                        value="{{ $pengajuan->nasabah->nama_lengkap }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NO. PENGAJUAN</label>
                                    <input type="text" class="form-control" name="nomor_pengajuan"
                                        value="{{ $pengajuan->nomor_pengajuan }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">TANGGAL SURVEY</label>
                                    <input type="date" class="form-control" name="tanggal_survei" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Plafon Pengajuan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="jumlah_plafon" step="0.01"
                                            value="{{ $pengajuan->nominal_pengajuan }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan Pemohon</label>
                                    <input type="text" class="form-control"
                                        value="{{ $pengajuan->nasabah->pekerjaan }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan Sampingan</label>
                                    <input type="text" class="form-control" name="pekerjaan_sampingan">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Hubungan dengan BMT</label>
                                    <select class="form-select" name="hubungan_dengan_bmt" required>
                                        <option value="baru">Baru</option>
                                        <option value="lama">Lama</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Hubungan (Jika Lama)</label>
                                    <input type="number" class="form-control" name="jumlah_hubungan">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Plafon Tertinggi Sebelumnya</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="plafon_tertinggi_sebelumnya"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Riwayat Pembayaran</label>
                                    <input type="text" class="form-control" name="riwayat_pembayaran">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Rekening Anggota</label>
                                    <input type="text" class="form-control" name="nomor_rekening_anggota">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Detail Penggunaan Dana</label>
                                    <textarea class="form-control" name="detail_penggunaan_dana" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            Analisa Usaha dan Kemampuan Bayar
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Usaha</label>
                                    <input type="text" class="form-control" name="jenis_usaha" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Lama Usaha (Tahun)</label>
                                    <input type="text" class="form-control" name="lama_usaha_tahun" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Tenaga Kerja</label>
                                    <input type="number" class="form-control" name="jumlah_tenaga_kerja" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Sistem Penjualan</label>
                                    <select name="sistem_penjualan" class="form-control" required>
                                        <option value="tunai">Tunai</option>
                                        <option value="angsuran">Angsuran</option>
                                        <option value="keduanya">Keduanya</option>
                                    </select>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Asset Usaha/Pribadi</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Persediaan Barang Dagangan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="persediaan_barang"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Aset Properti</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="aset_properti"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kendaraan Motor</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="jumlah_motor">
                                        <span class="input-group-text">Unit</span>
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="nilai_motor"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kendaraan Mobil</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="jumlah_mobil">
                                        <span class="input-group-text">Unit</span>
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="nilai_mobil"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Aset Lainnya</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="aset_lainnya" class="form-control"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 d-flex">
                                    <input type="hidden" name="total_aset" id="total_aset">
                                    <h4 class="fw-bold text-decoration-underline"> Total : <span
                                            class="total_aset"></span></h4>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Kewajiban yang Ditanggung</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Hutang Bank</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="hutang_bank"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Hutang Dagang</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="hutang_dagang"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Modal Sendiri</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="modal_sendiri"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 d-flex">
                                    <input type="hidden" name="total_kewajiban_modal" id="total_kewajiban_modal">
                                    <h4 class="fw-bold text-decoration-underline"> Total : <span
                                            class="total_tanggungan"></span></h4>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Kondisi Usaha</h5>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Tren Penjualan 3 Bulan Terakhir</label>
                                    <textarea class="form-control" name="tren_penjualan_3bulan" rows="3" required></textarea>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Penerimaan Bulanan</h5>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Omset Bulanan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="omset_bulanan"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Gaji Pemohon</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="gaji_pemohon"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Gaji Pasangan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="gaji_pasangan"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendapatan Lain</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="pendapatan_lain"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="hidden" name="total_pendapatan" id="total_pendapatan">
                                    <h4 class="fw-bold text-decoration-underline"> Total : <span
                                            class="total_pendapatan"></span></h4>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Pengeluaran Bulanan</h5>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kebutuhan Pokok</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="kebutuhan_pokok"
                                            step="0.01" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Biaya Pendidikan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="biaya_pendidikan"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Pengeluaran Lainnya</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="pengeluaran_lainnya"
                                            step="0.01" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Total Pengeluaran Rutin</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="total_pengeluaran_rutin"
                                            step="0.01" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kemampuan Bayar</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="kemampuan_bayar"
                                            step="0.01" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            Analisa Jaminan
                        </div>
                        <div class="card-body">
                            <h5 class="mb-3">Jaminan Kendaraan</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kendaraan</label>
                                    <input type="text" class="form-control" name="jenis_kendaraan">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Merk/Tipe</label>
                                    <input type="text" class="form-control" name="merk_tipe">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Nomor Polisi</label>
                                    <input type="text" class="form-control" name="nomor_polisi">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tahun Pembuatan</label>
                                    <input type="text" class="form-control" name="tahun_pembuatan">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Atas Nama</label>
                                    <input type="text" class="form-control" name="nama_pemilik">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Rangka</label>
                                    <input type="text" class="form-control" name="nomor_rangka">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Mesin</label>
                                    <input type="text" class="form-control" name="nomor_mesin">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor BPKB</label>
                                    <input type="text" class="form-control" name="nomor_bpkb">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hubungan dengan Anggota</label>
                                    <input type="text" class="form-control" name="hubungan_dengan_anggota">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga Pasar Kendaraan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="harga_pasar_kendaraan"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nilai Taksasi Kendaraan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="nilai_taksasi_kendaraan"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Kondisi Jaminan Kendaraan</label>
                                    <textarea class="form-control" name="kondisi_jaminan_kendaraan" rows="2"></textarea>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Jaminan Sertifikat</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Sertifikat</label>
                                    <input type="text" class="form-control" name="jenis_sertifikat"
                                        placeholder="SHM/SHGU/SHGB">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Sertifikat</label>
                                    <input type="text" class="form-control" name="nomor_sertifikat">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Atas Nama</label>
                                    <input type="text" class="form-control" name="pemilik_sertifikat">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Luas Tanah/Bangunan</label>
                                    <input type="text" class="form-control" name="luas_tanah_bangunan">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor/Tanggal Ukur</label>
                                    <input type="text" class="form-control" name="nomor_tanggal_ukur">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hubungan Pemilik</label>
                                    <input type="text" class="form-control" name="hubungan_pemilik">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga Pasar Tanah</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="harga_pasar_tanah"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nilai Taksasi Tanah</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="nilai_taksasi_tanah"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Kondisi Jaminan Tanah</label>
                                    <textarea class="form-control" name="kondisi_jaminan_tanah" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            Persetujuan Pembiayaan
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Plafon Disetujui</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="plafon_disetujui"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jangka Waktu Disetujui</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="jangka_waktu_disetujui">
                                        <span class="input-group-text">Bulan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Sistem Pembayaran</label>
                                    <select class="form-select" name="sistem_pembayaran">
                                        <option value="bulanan">Bulanan</option>
                                        <option value="jatuh_tempo">Jatuh Tempo</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Akad Pembiayaan</label>
                                    <select class="form-select" name="akad_pembiayaan">
                                        <option value="mudharabah">Mudharabah</option>
                                        <option value="murabahah">Murabahah</option>
                                        <option value="musyarakah">Musyarakah</option>
                                        <option value="multi_jasa">Multi Jasa</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Akad Lainnya</label>
                                    <input type="text" class="form-control" name="jenis_akad_lainnya">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Persentase Bagi Hasil</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="persentase_bagi_hasil"
                                            step="0.01">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Angsuran Bulanan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="angsuran_bulanan"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Aplikasi</label>
                                    <select class="form-select" name="status_aplikasi">
                                        <option value="diajukan">Diajukan</option>
                                        <option value="diperiksa">Diperiksa</option>
                                        <option value="disetujui">Disetujui</option>
                                        <option value="ditolak">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-4 mb-3">
                                    <h6>Diajukan,</h6>
                                    <p>Account Officer</p>
                                    <select class="form-select" name="account_officer_id">
                                        <!-- Options will be populated dynamically -->
                                    </select>
                                    <br>
                                    <br>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h6>Diperiksa,</h6>
                                    <p>Manager</p>
                                    <select class="form-select" name="manager_id">
                                        <!-- Options will be populated dynamically -->
                                    </select>
                                    <br>
                                    <br>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h6>Disetujui,</h6>
                                    <p>Ketua Umum</p>
                                    <input type="text" class="form-control" placeholder="Nama">
                                    <br>
                                    <br>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-lg">Submit Pengajuan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        function calculateTotal(inputs, targetInput, targetSpan) {
            let total = 0;
            inputs.forEach(input => {
                total += parseFloat($(`input[name=${input}]`).val()) || 0;
            });

            $(`input[name=${targetInput}]`).val(total);
            $(`.${targetSpan}`).html(total.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }));
        }

        $(document).ready(function() {
            // Konfigurasi perhitungan total untuk setiap kelompok input
            const calculations = {
                aset: {
                    inputs: ['persediaan_barang', 'aset_properti', 'nilai_motor', 'nilai_mobil',
                        'aset_lainnya'
                    ],
                    targetInput: 'total_aset',
                    targetSpan: 'total_aset'
                },
                tanggungan: {
                    inputs: ['hutang_bank', 'hutang_dagang', 'modal_sendiri'],
                    targetInput: 'total_tanggungan',
                    targetSpan: 'total_tanggungan'
                },
                pendapatan: {
                    inputs: ['omset_bulanan', 'gaji_pemohon', 'gaji_pasangan', 'pendapatan_lain'],
                    targetInput: 'total_pendapatan',
                    targetSpan: 'total_pendapatan'
                }
            };

            // Setup event listeners untuk semua input
            Object.values(calculations).forEach(calc => {
                calc.inputs.forEach(input => {
                    $(`input[name=${input}]`).on('input', () => {
                        calculateTotal(calc.inputs, calc.targetInput, calc.targetSpan);
                    });
                });
            });
        });
    </script>
</body>

</html>
