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
                                    <label class="form-label">NAMA</label>
                                    <input type="text" class="form-control" name="nama">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NO. PENGAJUAN</label>
                                    <input type="text" class="form-control" name="no_pengajuan">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label class="form-label">ALAMAT</label>
                                    <textarea class="form-control" name="alamat" rows="3"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">TANGGAL SURVEY</label>
                                    <input type="date" class="form-control" name="tanggal_survey">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Plafon Pengajuan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="jumlah_plafon">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kegunaan Dana Pembiayaan</label>
                                    <input type="text" class="form-control" name="kegunaan_dana">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Jangka Waktu</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="jangka_waktu">
                                        <span class="input-group-text">Bulan</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan Pemohon</label>
                                    <input type="text" class="form-control" name="pekerjaan_pemohon">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan Sampingan</label>
                                    <input type="text" class="form-control" name="pekerjaan_sampingan">
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
                                <div class="col-md-4">
                                    <label class="form-label">Jenis Usaha</label>
                                    <input type="text" class="form-control" name="jenis_usaha">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Lama Usaha</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="lama_usaha">
                                        <span class="input-group-text">Tahun</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Jumlah Tenaga Kerja</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="jumlah_tenaga_kerja">
                                        <span class="input-group-text">Orang</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Sistem Penjualan Tunai</label>
                                    <input type="text" class="form-control" name="sistem_penjualan_tunai">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Sistem Penjualan Angsuran</label>
                                    <input type="text" class="form-control" name="sistem_penjualan_angsuran">
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Asset Usaha/Pribadi</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Persediaan Barang Dagangan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="persediaan_barang">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Asset Rumah/Toko/Sawah</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="asset_lain">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Asset Kendaraan Motor</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="jumlah_motor">
                                        <span class="input-group-text">Unit</span>
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="asset_motor">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Asset Kendaraan Mobil</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="jumlah_mobil">
                                        <span class="input-group-text">Unit</span>
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="asset_mobil">
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
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kendaraan</label>
                                    <input type="text" class="form-control" name="jenis_kendaraan">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Merk/Type</label>
                                    <input type="text" class="form-control" name="merk_kendaraan">
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
                                    <input type="text" class="form-control" name="atas_nama_kendaraan">
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
                                    <label class="form-label">Besar Plafon</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="plafon_disetujui">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kegunaan</label>
                                    <input type="text" class="form-control" name="kegunaan_disetujui">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Jangka Waktu</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="jangka_waktu_disetujui">
                                        <span class="input-group-text">Bulan</span>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Akad Pembiayaan</label>
                                    <select class="form-select" name="akad_pembiayaan">
                                        <option>MUDHARABAH</option>
                                        <option>MURABAHAH</option>
                                        <option>MUSYARAKAH</option>
                                        <option>MULTI JASA</option>
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
                                    <input type="text" class="form-control" placeholder="Nama">
                                    <br>
                                    <br>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h6>Diperiksa,</h6>
                                    <p>Manager</p>
                                    <input type="text" class="form-control" placeholder="Nama">
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
</body>

</html>
