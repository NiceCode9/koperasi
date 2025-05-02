<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"="width=device-width, initial-scale=1">
    <title>Analisa Permohonan Pembiayaan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid py-4">
        <div class="row">
            @error('error')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <h1 class="text-center mb-4 text-primary">ANALISA PERMOHONAN PEMBIAYAAN</h1>

                <form
                    action="{{ isset($data) ? route('marketing.riwayat.survei.update', $data->id) : route('marketing.pengajuan.survei.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($data))
                        @method('PUT')
                    @endif
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            Informasi Dasar
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">NAMA NASABAH</label>
                                    <input type="hidden"
                                        value="{{ isset($data) ? $data->pengajuan_id : $pengajuan->id }}"
                                        name="pengajuan_id">
                                    <input type="text"
                                        class="form-control @error('nama_nasabah') is-invalid @enderror"
                                        name="nama_nasabah"
                                        value="{{ old('nama_nasabah', isset($data) ? $data->pengajuan->nasabah->nama_lengkap : $pengajuan->nasabah->nama_lengkap) }}">
                                    @error('nama_nasabah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NO. PENGAJUAN</label>
                                    <input type="text"
                                        class="form-control @error('nomor_pengajuan') is-invalid @enderror"
                                        name="nomor_pengajuan"
                                        value="{{ old('nomor_pengajuan', isset($data) ? $data->pengajuan->nomor_pengajuan : $pengajuan->nomor_pengajuan) }}"
                                        required>
                                    @error('nomor_pengajuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">TANGGAL SURVEY</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_survei') is-invalid @enderror"
                                        name="tanggal_survei"
                                        value="{{ old('tanggal_survei', isset($data) ? $data->tanggal_survei->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                        required>
                                    @error('tanggal_survei')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Plafon Pengajuan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text"
                                            class="form-control @error('jumlah_plafon') is-invalid @enderror"
                                            name="jumlah_plafon" step="0.01"
                                            value="{{ old('jumlah_plafon', isset($data) ? number_format($data->pengajuan->nominal_pengajuan, 0, ',', '.') : number_format($pengajuan->nominal_pengajuan, 0, ',', '.')) }}"
                                            required>
                                        @error('jumlah_plafon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan Pemohon</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('pekerjaan_pemohon', isset($data) ? $data->pengajuan->nasabah->pekerjaan : $pengajuan->nasabah->pekerjaan) }}"
                                        name="pekerjaan_pemohon" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan Sampingan</label>
                                    <input type="text"
                                        class="form-control @error('pekerjaan_sampingan') is-invalid @enderror"
                                        name="pekerjaan_sampingan" value="{{ old('pekerjaan_sampingan') }}">
                                    @error('pekerjaan_sampingan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Hubungan dengan BMT</label>
                                    <select class="form-select @error('hubungan_dengan_bmt') is-invalid @enderror"
                                        name="hubungan_dengan_bmt" required>
                                        <option value="baru"
                                            {{ old('hubungan_dengan_bmt', isset($data) ? $data->hubungan_dengan_bmt : '') == 'baru' ? 'selected' : '' }}>
                                            Baru</option>
                                        <option value="lama"
                                            {{ old('hubungan_dengan_bmt', isset($data) ? $data->hubungan_dengan_bmt : '') == 'lama' ? 'selected' : '' }}>
                                            Lama</option>
                                    </select>
                                    @error('hubungan_dengan_bmt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Hubungan (Jika Lama)</label>
                                    <input type="text"
                                        class="form-control @error('jumlah_hubungan') is-invalid @enderror"
                                        name="jumlah_hubungan"
                                        value="{{ old('jumlah_hubungan', isset($data) ?? $data->jumlah_hubungan) }}">
                                    @error('jumlah_hubungan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Plafon Tertinggi Sebelumnya</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text"
                                            class="form-control @error('plafon_tertinggi_sebelumnya') is-invalid @enderror"
                                            name="plafon_tertinggi_sebelumnya" step="0.01"
                                            value="{{ old('plafon_tertinggi_sebelumnya', isset($data) ? number_format($data->plafon_tertinggi_sebelumnya, 0, ',', '.') : '') }}">
                                        @error('plafon_tertinggi_sebelumnya')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Riwayat Pembayaran</label>
                                    <input type="text"
                                        class="form-control @error('riwayat_pembayaran') is-invalid @enderror"
                                        name="riwayat_pembayaran"
                                        value="{{ old('riwayat_pembayaran', isset($data) ? $data->riwayat_pembayaran : '') }}">
                                    @error('riwayat_pembayaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Rekening Anggota</label>
                                    <input type="text"
                                        class="form-control @error('nomor_rekening_anggota') is-invalid @enderror"
                                        name="nomor_rekening_anggota"
                                        value="{{ old('nomor_rekening_anggota', isset($data) ? $data->nomor_rekening_anggota : '') }}">
                                    @error('nomor_rekening_anggota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Detail Penggunaan Dana</label>
                                    <textarea class="form-control @error('detail_penggunaan_dana') is-invalid @enderror" name="detail_penggunaan_dana"
                                        rows="3" required>{{ old('detail_penggunaan_dana', isset($data) ? $data->detail_penggunaan_dana : '') }}</textarea>
                                    @error('detail_penggunaan_dana')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                    <input type="text"
                                        class="form-control @error('jenis_usaha') is-invalid @enderror"
                                        name="jenis_usaha"
                                        value="{{ old('jenis_usaha', isset($data) ? $data->jenis_usaha : '') }}"
                                        required>
                                    @error('jenis_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Lama Usaha (Tahun)</label>
                                    <input type="text"
                                        class="form-control @error('lama_usaha_tahun') is-invalid @enderror"
                                        name="lama_usaha_tahun"
                                        value="{{ old('lama_usaha_tahun', isset($data) ? $data->lama_usaha_tahun : '') }}"
                                        required>
                                    @error('lama_usaha_tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Tenaga Kerja</label>
                                    <input type="text" class="form-control" name="jumlah_tenaga_kerja"
                                        value="{{ old('jumlah_tenaga_kerja', isset($data) ? $data->jumlah_tenaga_kerja : '') }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Sistem Penjualan</label>
                                    <select name="sistem_penjualan" class="form-control" required>
                                        <option value="tunai"
                                            {{ old('sistem_penjualan', isset($data) ? $data->sistem_penjualan : '') == 'tunai' ? 'selected' : '' }}>
                                            Tunai</option>
                                        <option value="angsuran"
                                            {{ old('sistem_penjualan', isset($data) ? $data->sistem_penjualan : '') == 'angsuran' ? 'selected' : '' }}>
                                            Angsuran
                                        </option>
                                        <option value="keduanya"
                                            {{ old('sistem_penjualan', isset($data) ? $data->sistem_penjualan : '') == 'keduanya' ? 'selected' : '' }}>
                                            Keduanya
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Asset Usaha/Pribadi</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Persediaan Barang Dagangan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="persediaan_barang"
                                            step="0.01"
                                            value="{{ old('persediaan_barang', isset($data) ? number_format($data->persediaan_barang, 0, ',', '.') : '') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Aset Properti</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="aset_properti"
                                            step="0.01"
                                            value="{{ old('aset_properti', isset($data) ? number_format($data->aset_properti, 0, ',', '.') : '') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kendaraan Motor</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="jumlah_motor"
                                            value="{{ old('jumlah_motor', isset($data) ? $data->jumlah_motor : '') }}">
                                        <span class="input-group-text">Unit</span>
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="nilai_motor"
                                            value="{{ old('nilai_motor', isset($data) ? number_format($data->nilai_motor, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kendaraan Mobil</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="jumlah_mobil"
                                            value="{{ old('jumlah_mobil', isset($data) ? $data->jumlah_mobil : '') }}">
                                        <span class="input-group-text">Unit</span>
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="nilai_mobil"
                                            value="{{ old('nilai_mobil', isset($data) ? number_format($data->nilai_mobil, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Aset Lainnya</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" name="aset_lainnya" class="form-control"
                                            value="{{ old('aset_lainnya', isset($data) ? number_format($data->aset_lainnya, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 d-flex">
                                    <input type="hidden" name="total_aset" id="total_aset"
                                        value="{{ old('total_aset', isset($data) ? $data->total_aset : '') }}">
                                    <h4 class="fw-bold text-decoration-underline"> Total : <span
                                            class="total_aset"></span>
                                    </h4>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Kewajiban yang Ditanggung</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Hutang Bank</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="hutang_bank"
                                            value="{{ old('hutang_bank', isset($data) ? number_format($data->hutang_bank, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Hutang Dagang</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="hutang_dagang"
                                            value="{{ old('hutang_dagang', isset($data) ? number_format($data->hutang_dagang, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Modal Sendiri</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="modal_sendiri"
                                            value="{{ old('modal_sendiri', isset($data) ? number_format($data->modal_sendiri, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 d-flex">
                                    <input type="hidden" name="total_kewajiban_modal" id="total_kewajiban_modal"
                                        value="{{ old('total_kewajiban_modal', isset($data) ? $data->total_kewajiban_modal : '') }}">
                                    <h4 class="fw-bold text-decoration-underline"> Total : <span
                                            class="total_tanggungan"></span></h4>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Kondisi Usaha</h5>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Tren Penjualan 3 Bulan Terakhir</label>
                                    <textarea class="form-control" name="tren_penjualan_3bulan" rows="3" required>{{ old('tren_penjualan_3bulan', isset($data) ? $data->tren_penjualan_3bulan : '') }}</textarea>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Pendapatan dari usaha/bulan</h5>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Omset Bulanan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="omset_bulanan"
                                            value="{{ old('omset_bulanan', isset($data) ? number_format($data->omset_bulanan, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label">Biaya Bahan Baku</div>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="biaya_bahan"
                                            value="{{ old('biaya_bahan', isset($data) ? number_format($data->biaya_bahan, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label">Biaya Tenaga Kerja</div>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="biaya_tenaga_kerja"
                                            value="{{ old('biaya_tenaga_kerja', isset($data) ? number_format($data->biaya_tenaga_kerja, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label">Biaya Lainnya</div>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="biaya_lainnya"
                                            value="{{ old('biaya_lainnya', isset($data) ? number_format($data->biaya_lainnya, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                    <input type="hidden" name="total_biaya" id="total_biaya"
                                        value="{{ old('total_biaya', isset($data) ? $data->total_biaya : '') }}">
                                    <input type="hidden" name="pendapatan_usaha_bulanan"
                                        value="{{ old('pendapatan_usaha_bulanan', isset($data) ? $data->pendapata_usaha_bulanan : '') }}"
                                        id="pendapatan_usaha_bulanan">
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Penerimaan Bulanan</h5>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gaji Pemohon</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="gaji_pemohon"
                                            value="{{ old('gaji_pemohon', isset($data) ? number_format($data->gaji_pemohon, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gaji Pasangan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="gaji_pasangan"
                                            value="{{ old('gaji_pasangan', isset($data) ? number_format($data->gaji_pasangan, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendapatan Lain</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="pendapatan_lain"
                                            value="{{ old('pendapatan_lain', isset($data) ? number_format($data->pendapatan_lain, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <input type="hidden" name="total_pendapatan" id="total_pendapatan"
                                        value="{{ old('total_pendapatan', isset($data) ? $data->total_pendapatan : '') }}">
                                    <h4 class="fw-bold text-decoration-underline"> Jumlah Pendapatan : <span
                                            class="total_pendapatan"></span></h4>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Pengeluaran Bulanan</h5>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kebutuhan Pokok</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="kebutuhan_pokok"
                                            value="{{ old('kebutuhan_pokok', isset($data) ? number_format($data->kebutuhan_pokok, 0, ',', '.') : '') }}"
                                            step="0.01" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Biaya Pendidikan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="biaya_pendidikan"
                                            step="0.01"
                                            value="{{ old('biaya_pendidikan', isset($data) ? number_format($data->biaya_pendidikan, 0, ',', '.') : '') }}">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Pengeluaran Lainnya</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="pengeluaran_lainnya"
                                            value="{{ old('pengeluaran_lainnya', isset($data) ? number_format($data->pengeluaran_lainnya, 0, ',', '.') : '') }}"
                                            step="0.01" required>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <input type="hidden" class="form-control" name="total_pengeluaran_rutin"
                                        step="0.01"
                                        value="{{ old('total_pengeluaran_rutin', isset($data) ? $data->total_pengeluaran_rutin : '') }}"
                                        required>
                                    <h4 class="fw-bold text-decoration-underline"> Total Pengeluaran Rutin : <span
                                            class="total_pengeluaran_rutin"></span></h4>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kemampuan Bayar</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <select class="form-control" name="kemampuan_bayar" required>
                                            <option value="">Pilih Kemampuan Bayar</option>
                                            <option value="Baik"
                                                {{ old('kemampuan_bayar', isset($data) ? $data->kemampuan_bayar : '') == 'Baik' ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="Cukup"
                                                {{ old('kemampuan_bayar', isset($data) ? $data->kemampuan_bayar : '') == 'Cukup' ? 'selected' : '' }}>
                                                Cukup</option>
                                            <option value="Kurang"
                                                {{ old('kemampuan_bayar', isset($data) ? $data->kemampuan_bayar : '') == 'Kurang' ? 'selected' : '' }}>
                                                Kurang</option>
                                        </select>
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
                                    <input type="text"
                                        class="form-control @error('jenis_kendaraan') is-invalid @enderror"
                                        name="jenis_kendaraan"
                                        value="{{ old('jenis_kendaraan', isset($data) ? $data->jenis_kendaraan : '') }}">
                                    @error('jenis_kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Merk/Tipe</label>
                                    <input type="text"
                                        class="form-control @error('merk_tipe') is-invalid @enderror"
                                        name="merk_tipe"
                                        value="{{ old('merk_tipe', isset($data) ? $data->merk_tipe : '') }}">
                                    @error('merk_tipe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Nomor Polisi</label>
                                    <input type="text"
                                        class="form-control @error('nomor_polisi') is-invalid @enderror"
                                        name="nomor_polisi"
                                        value="{{ old('nomor_polisi', isset($data) ? $data->nomor_polisi : '') }}">
                                    @error('nomor_polisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tahun Pembuatan</label>
                                    <input type="text"
                                        class="form-control @error('tahun_pembuatan') is-invalid @enderror"
                                        name="tahun_pembuatan"
                                        value="{{ old('tahun_pembuatan', isset($data) ? $data->tahun_pembuatan : '') }}">
                                    @error('tahun_pembuatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Atas Nama</label>
                                    <input type="text"
                                        class="form-control @error('nama_pemilik') is-invalid @enderror"
                                        name="nama_pemilik"
                                        value="{{ old('nama_pemilik', isset($data) ? $data->nama_pemilik : '') }}">
                                    @error('nama_pemilik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Rangka</label>
                                    <input type="text"
                                        class="form-control @error('nomor_rangka') is-invalid @enderror"
                                        name="nomor_rangka"
                                        value="{{ old('nomor_rangka', isset($data) ? $data->nomor_rangka : '') }}">
                                    @error('nomor_rangka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Mesin</label>
                                    <input type="text"
                                        class="form-control @error('nomor_mesin') is-invalid @enderror"
                                        name="nomor_mesin"
                                        value="{{ old('nomor_mesin', isset($data) ? $data->nomor_mesin : '') }}">
                                    @error('nomor_mesin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor BPKB</label>
                                    <input type="text"
                                        class="form-control @error('nomor_bpkb') is-invalid @enderror"
                                        name="nomor_bpkb"
                                        value="{{ old('nomor_bpkb', isset($data) ? $data->nomor_bpkb : '') }}">
                                    @error('nomor_bpkb')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hubungan dengan Anggota</label>
                                    <input type="text" class="form-control" name="hubungan_dengan_anggota"
                                        value="{{ old('hubungan_dengan_anggota', isset($data) ? $data->hubungan_dengan_anggota : '') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="bukit_kepemilikan" class="form-label">Bukti Kepemilikan</label>
                                    <select name="bukti_kepemilikan" id="bukti_kepemilikan" class="form-control"
                                        required>
                                        <option value="Ada"
                                            {{ old('bukti_kepemilikan', isset($data) ? $data->bukti_kepemilikan : '') == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Kwitansi Jual Beli"
                                            {{ old('bukti_kepemilikan', isset($data) ? $data->bukti_kepemilikan : '') == 'Kwitansi Jual Beli' ? 'selected' : '' }}>
                                            Kwitansi Jual Beli</option>
                                        <option value="Surat Keterangan"
                                            {{ old('bukti_kepemilikan', isset($data) ? $data->bukti_kepemilikan : '') == 'Surat Keterangan' ? 'selected' : '' }}>
                                            Surat Keterangan</option>
                                        <option value="Tidak Ada"
                                            {{ old('bukti_kepemilikan', isset($data) ? $data->bukti_kepemilikan : '') == 'Tidak Ada' ? 'selected' : '' }}>
                                            Tidak Ada</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Harga Pasar Kendaraan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="harga_pasar_kendaraan"
                                            value="{{ old('harga_pasar_kendaraan', isset($data) ? number_format($data->harga_pasar_kendaraan, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Nilai Taksasi Kendaraan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="nilai_taksasi_kendaraan"
                                            value="{{ old('nilai_taksasi_kendaraan', isset($data) ? number_format($data->nilai_taksasi_kendaraan, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Kondisi Jaminan Kendaraan</label>
                                    <textarea class="form-control" name="kondisi_jaminan_kendaraan" rows="2">{{ old('kondisi_jaminan_kendaraan', isset($data) ? $data->kondisi_jaminan_kendaraan : '') }}</textarea>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Jaminan Sertifikat</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Sertifikat</label>
                                    <input type="text" class="form-control" name="jenis_sertifikat"
                                        value="{{ old('jenis_sertifikat', isset($data) ? $data->jenis_sertifikat : '') }}"
                                        placeholder="SHM/SHGU/SHGB">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Sertifikat</label>
                                    <input type="text" class="form-control" name="nomor_sertifikat"
                                        value="{{ old('nomor_sertifikat', isset($data) ? $data->nomor_sertifikat : '') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Atas Nama</label>
                                    <input type="text" class="form-control" name="pemilik_sertifikat"
                                        value="{{ old('pemilik_sertifikat', isset($data) ? $data->pemilik_sertifikat : '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Luas Tanah/Bangunan</label>
                                    <input type="text" class="form-control" name="luas_tanah_bangunan"
                                        value="{{ old('luas_tanah_bangunan', isset($data) ? $data->luas_tanah_bangunan : '') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor/Tanggal Ukur</label>
                                    <input type="text" class="form-control" name="nomor_tanggal_ukur"
                                        value="{{ old('nomor_tanggal_ukur', isset($data) ? $data->nomor_tanggal_ukur : '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hubungan Pemilik</label>
                                    <input type="text" class="form-control" name="hubungan_pemilik"
                                        value="{{ old('hubungan_pemilik', isset($data) ? $data->hubungan_pemilik : '') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga Pasar Tanah</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="harga_pasar_tanah"
                                            value="{{ old('harga_pasar_tanah', isset($data) ? number_format($data->harga_pasar_tanah, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nilai Taksasi Tanah</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="nilai_taksasi_tanah"
                                            value="{{ old('harga_taksasi_tanah', isset($data) ? number_format($data->nilai_taksasi_tanah, 0, ',', '.') : '') }}"
                                            step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Kondisi Jaminan Tanah</label>
                                    <textarea class="form-control" name="kondisi_jaminan_tanah" rows="2">{{ old('kondisi_jaminan_tanah', isset($data) ? $data->kondisi_jaminan_tanah : '') }}</textarea>
                                </div>
                            </div>
                            {{-- <div class="text-center mt-3">
                                <button type="submit"
                                    class="btn btn-primary btn-lg">{{ isset($data) ? 'Update' : 'Submit' }}
                                    Pengajuan</button>
                            </div> --}}
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                PERSETUJUAN PENGAJUAN PEMBIAYAAN
                            </div>
                            <div class="card-body">
                                <p class="mb-2">Berdasarkan analisa yang telah kami lakukan dengan seksama, maka
                                    berdasarkan pertimbangan kami bahwa anggota layak untuk mendapatkan fasilitas
                                    pembiayaan : </p>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nominal_disetujui" class="form-label">Nominal Disetujui</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" class="form-control" name="nominal_disetujui"
                                                value="{{ old('nominal_disetujui', isset($data) ? number_format($data->plafon_disetujui, 0, ',', '.') : '') }}"
                                                step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="keperluan" class="form-label">Keperluan</label>
                                        <input type="text" class="form-control"
                                            value="{{ old('keperluan', isset($data) ? $data->keperluan : '') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="jangka_waktu_disetujui" class="form-label">Jangka Waktu
                                            Disetujui</label>
                                        <input type="text" class="form-control" name="jangka_waktu_disetujui"
                                            value="{{ old('jangka_waktu_disetujui', isset($data) ? $data->jangka_waktu_disetujui : '') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="sistem_pembayaran" class="form-label">Sistem Pembayaran</label>
                                        <select name="sistem_pembayaran" id="sistem_pembayaran" class="form-control"
                                            required>
                                            <option value="bulanan">BULANAN</option>
                                            <option value="jatuh_tempo">JATUH TEMPO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="akad_pembiayaan" class="form-label">Akad Pembiayaan</label>
                                        <select name="akad_pembiayaan" id="akad_pembiayaan" class="form-control"
                                            required>
                                            <option value="mudharabah">MUDHARABAH</option>
                                            <option value="murabahah">MURABAHAH</option>
                                            <option value="musyarakah">MUSYARAKAH</option>
                                            <option value="multi_jasa">MULTI JASA</option>
                                            <option value="lainnya">LAINNYA</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="harga_jual_bmt" class="form-label">Harga Jual BMT</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" class="form-control" name="harga_jual_bmt"
                                                value="{{ old('harga_jual_bmt', isset($data) ? number_format($data->harga_jual_bmt, 0, ',', '.') : '') }}"
                                                step="0.01">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="persentase_bagi_hasil" class="form-label">Nisbah Bagi
                                            Hasil BMT</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="persentase_bagi_hasil"
                                                value="{{ old('persentase_bagi_hasil', isset($data) ? $data->persentase_bagi_hasil : '') }}"
                                                step="0.01">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pendapatan_setara_bulanan" class="form-label">Setara
                                            Pendapatan/bulan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" class="form-control"
                                                name="pendapatan_setara_bulanan"
                                                value="{{ old('pendapatan_setara_bulanan', isset($data) ? number_format($data->pendapatan_setara_bulanan, 0, ',', '.') : '') }}"
                                                step="0.01">
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mt-4 mb-3">Biaya Pengajuan</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="biaya_administrasi" class="form-label">Biaya Administrasi</label>
                                        <input type="text" class="form-control" name="biaya_administrasi"
                                            value="{{ old('biaya_administrasi', isset($data) ? number_format($data->biaya_administrasi, 0, ',', '.') : '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="biaya_notaris" class="form-label">Biaya Notaris</label>
                                        <input type="text" class="form-control" name="biaya_notaris"
                                            value="{{ old('biaya_notaris', isset($data) ? number_format($data->biaya_notaris, 0, ',', '.') : '') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="biaya_materai" class="form-label">Biaya Materai</label>
                                        <input type="text" class="form-control" name="biaya_materai"
                                            value="{{ old('biaya_materai', isset($data) ? number_format($data->biaya_materai, 0, ',', '.') : '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="biaya_asuransi" class="form-label">Biaya Asuransi</label>
                                        <input type="text" class="form-control" name="biaya_asuransi"
                                            value="{{ old('biaya_asuransi', isset($data) ? number_format($data->biaya_asuransi, 0, ',', '.') : '') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="biaya_lain" class="form-label">Biaya Lain</label>
                                        <input type="text" class="form-control" name="biaya_lain"
                                            value="{{ old('biaya_lain', isset($data) ? number_format($data->biaya_lain, 0, ',', '.') : '') }}">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <input type="hidden" class="form-control" name="total_biaya_admin"
                                            step="0.01"
                                            value="{{ old('total_biaya_admin', isset($data) ? $data->total_biaya_admin : '') }}"
                                            required>
                                        <h4 class="fw-bold text-decoration-underline"> Total Biaya Admin : <span
                                                class="total_biaya_admin"></span></h4>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit"
                                        class="btn btn-primary btn-lg">{{ isset($data) ? 'Update' : 'Submit' }}
                                        Pengajuan</button>
                                </div>
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
    {{-- <script>
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

        function jumlah_pendapatan() {
            let total_pendapatan = 0;
            let total_biaya = 0;
            let pendapatan_usaha_bulanan = 0;
            total_biaya += parseFloat($(`input[name=biaya_bahan]`).val()) || 0;
            total_biaya += parseFloat($(`input[name=biaya_tenaga_kerja]`).val()) || 0;
            total_biaya += parseFloat($(`input[name=biaya_lainnya]`).val()) || 0;

            pendapatan_usaha_bulanan += parseFloat($(`input[name=omset_bulanan]`).val()) || 0;
            pendapatan_usaha_bulanan -= total_biaya;
            $(`input[name=pendapatan_usaha_bulanan]`).val(pendapatan_usaha_bulanan);
            $('input[name=total_biaya]').val(total_biaya);

            total_pendapatan += parseFloat($(`input[name=gaji_pemohon]`).val()) || 0;
            total_pendapatan += parseFloat($(`input[name=gaji_pasangan]`).val()) || 0;
            total_pendapatan += parseFloat($(`input[name=pendapatan_lain]`).val()) || 0;
            total_pendapatan += parseFloat($(`input[name=pendapatan_usaha_bulanan]`).val()) || 0;

            $(`input[name=total_pendapatan]`).val(total_pendapatan);
            $(`.total_pendapatan`).html(total_pendapatan.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }));
        }

        function formatRupiah(angka, prefix) {
            const numberString = angka.replace(/[^,\d]/g, '').toString();
            const split = numberString.split(',');
            const sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            const ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            console.log(numberString);


            if (ribuan) {
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return prefix === undefined ? rupiah : (rupiah ? prefix + rupiah : '');
        }

        function unformatRupiah(rupiah) {
            return rupiah.replace(/\./g, '');
        }

        $(document).ready(function() {
            // if ($('input[name=total_aset]').val()) {
            //     $('.total_aset').html(parseFloat($('input[name=total_aset]').val()).toLocaleString('id-ID', {
            //         style: 'currency',
            //         currency: 'IDR'
            //     }));
            // }

            const uangInputs = [
                'jumlah_plafon', 'plafon_tertinggi_sebelumnya', 'persediaan_barang', 'aset_properti',
                'nilai_motor', 'nilai_mobil', 'aset_lainnya', 'hutang_bank', 'hutang_dagang',
                'modal_sendiri', 'harga_pasar_kendaraan', 'nilai_taksasi_kendaraan', 'harga_pasar_tanah',
                'nilai_taksasi_tanah', 'omset_bulanan', 'biaya_bahan', 'biaya_tenaga_kerja',
                'biaya_lainnya', 'gaji_pemohon', 'gaji_pasangan', 'pendapatan_lain', 'biaya_administrasi',
                'biaya_notaris', 'biaya_materai', 'biaya_asuransi', 'biaya_lain'
            ];

            uangInputs.forEach(inputName => {
                const input = $(`input[name=${inputName}]`);

                // Format saat mengetik
                input.on('input', function() {
                    const value = $(this).val();
                    $(this).val(formatRupiah(value));
                });

                // Unformat sebelum submit
                $('form').on('submit', function() {
                    const value = input.val();
                    input.val(unformatRupiah(value));
                });
            });

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
                pengeluaran: {
                    inputs: ['kebutuhan_pokok', 'biaya_pendidikan', 'pengeluaran_lainnya'],
                    targetInput: 'total_pengeluaran_rutin',
                    targetSpan: 'total_pengeluaran_rutin'
                },
                biayaAdmin: {
                    inputs: ['biaya_administrasi', 'biaya_notaris', 'biaya_materai', 'biaya_asuransi',
                        'biaya_lain'
                    ],
                    targetInput: 'total_biaya_admin',
                    targetSpan: 'total_biaya_admin',
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

            Object.values(calculations).forEach(calc => {
                let total = 0;
                calc.inputs.forEach(input => {
                    let value = parseFloat($(`input[name=${input}]`).val()) || 0;
                    total += value;
                });
                $(`input[name=${calc.targetInput}]`).val(total);
                $(`.${calc.targetSpan}`).html(total.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }));
            });

            // Tambahkan event listener untuk fungsi jumlah_pendapatan
            const pendapatanInputs = ['biaya_bahan', 'biaya_tenaga_kerja', 'biaya_lainnya', 'omset_bulanan',
                'gaji_pemohon', 'gaji_pasangan', 'pendapatan_lain'
            ];
            pendapatanInputs.forEach(input => {
                $(`input[name=${input}]`).on('input', jumlah_pendapatan);
            });
        });
    </script> --}}
    <script>
        function formatRupiah(angka, prefix) {
            const numberString = angka.replace(/[^,\d]/g, '').toString();
            const split = numberString.split(',');
            const sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return prefix === undefined ? rupiah : (rupiah ? prefix + rupiah : '');
        }

        function unformatRupiah(rupiah) {
            return rupiah.replace(/\./g, '');
        }

        function calculateTotal(inputs, targetInput, targetSpan) {
            let total = 0;
            inputs.forEach(input => {
                const value = unformatRupiah($(`input[name=${input}]`).val()) || 0;
                total += parseFloat(value);
            });

            $(`input[name=${targetInput}]`).val(total);

            $(`.${targetSpan}`).html(total.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }));
        }

        function jumlah_pendapatan() {
            let total_pendapatan = 0;
            let total_biaya = 0;
            let pendapatan_usaha_bulanan = 0;

            total_biaya += parseFloat(unformatRupiah($(`input[name=biaya_bahan]`).val())) || 0;
            total_biaya += parseFloat(unformatRupiah($(`input[name=biaya_tenaga_kerja]`).val())) || 0;
            total_biaya += parseFloat(unformatRupiah($(`input[name=biaya_lainnya]`).val())) || 0;

            pendapatan_usaha_bulanan += parseFloat(unformatRupiah($(`input[name=omset_bulanan]`).val())) || 0;
            pendapatan_usaha_bulanan -= total_biaya;

            $(`input[name=pendapatan_usaha_bulanan]`).val(pendapatan_usaha_bulanan);
            $(`input[name=total_biaya]`).val(total_biaya);

            total_pendapatan += parseFloat(unformatRupiah($(`input[name=gaji_pemohon]`).val())) || 0;
            total_pendapatan += parseFloat(unformatRupiah($(`input[name=gaji_pasangan]`).val())) || 0;
            total_pendapatan += parseFloat(unformatRupiah($(`input[name=pendapatan_lain]`).val())) || 0;
            total_pendapatan += pendapatan_usaha_bulanan;

            $(`input[name=total_pendapatan]`).val(total_pendapatan);
            $(`.total_pendapatan`).html(total_pendapatan.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }));
        }

        $(document).ready(function() {
            const uangInputs = [
                'jumlah_plafon', 'plafon_tertinggi_sebelumnya', 'persediaan_barang', 'aset_properti',
                'nilai_motor', 'nilai_mobil', 'aset_lainnya', 'hutang_bank', 'hutang_dagang',
                'modal_sendiri', 'harga_pasar_kendaraan', 'nilai_taksasi_kendaraan', 'harga_pasar_tanah',
                'nilai_taksasi_tanah', 'omset_bulanan', 'biaya_bahan', 'biaya_tenaga_kerja',
                'biaya_lainnya', 'gaji_pemohon', 'gaji_pasangan', 'pendapatan_lain', 'biaya_administrasi',
                'biaya_notaris', 'biaya_materai', 'biaya_asuransi', 'biaya_lain', 'kebutuhan_pokok',
                'biaya_pendidikan', 'pengeluaran_lainnya', 'pendapatan_setara_bulanan', 'harga_jual_bmt',
                'nominal_disetujui',
            ];

            uangInputs.forEach(inputName => {
                const input = $(`input[name=${inputName}]`);

                // Format saat mengetik
                input.on('input', function() {
                    const value = $(this).val();
                    $(this).val(formatRupiah(value));
                });

                // Unformat sebelum submit
                $('form').on('submit', function() {
                    uangInputs.forEach(inputName => {
                        const input = $(`input[name=${inputName}]`);
                        const value = input.val();
                        input.val(unformatRupiah(value));
                    });
                });
            });

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
                pengeluaran: {
                    inputs: ['kebutuhan_pokok', 'biaya_pendidikan', 'pengeluaran_lainnya'],
                    targetInput: 'total_pengeluaran_rutin',
                    targetSpan: 'total_pengeluaran_rutin'
                },
                biayaAdmin: {
                    inputs: ['biaya_administrasi', 'biaya_notaris', 'biaya_materai', 'biaya_asuransi',
                        'biaya_lain'
                    ],
                    targetInput: 'total_biaya_admin',
                    targetSpan: 'total_biaya_admin'
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

            // Hitung ulang total saat halaman dimuat
            Object.values(calculations).forEach(calc => {
                calculateTotal(calc.inputs, calc.targetInput, calc.targetSpan);
            });

            // Tambahkan event listener untuk fungsi jumlah_pendapatan
            const pendapatanInputs = ['biaya_bahan', 'biaya_tenaga_kerja', 'biaya_lainnya', 'omset_bulanan',
                'gaji_pemohon', 'gaji_pasangan', 'pendapatan_lain'
            ];
            pendapatanInputs.forEach(input => {
                $(`input[name=${input}]`).on('input', jumlah_pendapatan);
            });

            // Hitung ulang pendapatan saat halaman dimuat
            jumlah_pendapatan();
        });
    </script>
</body>

</html>
