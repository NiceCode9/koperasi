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
            @error('error')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
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
                                        name="tanggal_survei" value="{{ old('tanggal_survei') }}" required>
                                    @error('tanggal_survei')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Plafon Pengajuan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number"
                                            class="form-control @error('jumlah_plafon') is-invalid @enderror"
                                            name="jumlah_plafon" step="0.01"
                                            value="{{ old('jumlah_plafon', isset($data) ? $data->pengajuan->nominal_pengajuan : $pengajuan->nominal_pengajuan) }}"
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
                                    <input type="number"
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
                                        <input type="number"
                                            class="form-control @error('plafon_tertinggi_sebelumnya') is-invalid @enderror"
                                            name="plafon_tertinggi_sebelumnya" step="0.01"
                                            value="{{ old('plafon_tertinggi_sebelumnya', isset($data) ? $data->plafon_tertinggi_sebelumnya : '') }}">
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
                                    <input type="number" class="form-control" name="jumlah_tenaga_kerja"
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
                                        <input type="number" class="form-control" name="persediaan_barang"
                                            step="0.01" value="{{ old('persediaan_barang') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Aset Properti</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="aset_properti"
                                            step="0.01" value="{{ old('aset_properti') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kendaraan Motor</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="jumlah_motor"
                                            value="{{ old('jumlah_motor') }}">
                                        <span class="input-group-text">Unit</span>
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="nilai_motor"
                                            value="{{ old('nilai_motor') }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kendaraan Mobil</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="jumlah_mobil"
                                            value="{{ old('jumlah_mobil') }}">
                                        <span class="input-group-text">Unit</span>
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="nilai_mobil"
                                            value="{{ old('nilai_mobil') }}" step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Aset Lainnya</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="aset_lainnya" class="form-control"
                                            value="{{ old('aset_lainnya') }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 d-flex">
                                    <input type="hidden" name="total_aset" id="total_aset"
                                        value="{{ old('total_aset') }}">
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
                                            value="{{ old('hutang_bank') }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Hutang Dagang</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="hutang_dagang"
                                            value="{{ old('hutang_dagang') }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Modal Sendiri</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="modal_sendiri"
                                            value="{{ old('modal_sendiri') }}" step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 d-flex">
                                    <input type="hidden" name="total_kewajiban_modal" id="total_kewajiban_modal"
                                        value="{{ old('total_kewajiban_modal') }}">
                                    <h4 class="fw-bold text-decoration-underline"> Total : <span
                                            class="total_tanggungan"></span></h4>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Kondisi Usaha</h5>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Tren Penjualan 3 Bulan Terakhir</label>
                                    <textarea class="form-control" name="tren_penjualan_3bulan" rows="3" required>{{ old('tren_penjualan_3bulan') }}</textarea>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Pendapatan dari usaha/bulan</h5>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Omset Bulanan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="omset_bulanan"
                                            value="{{ old('omset_bulanan') }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label">Biaya Bahan Baku</div>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="biaya_bahan"
                                            value="{{ old('biaya_bahan') }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label">Biaya Tenaga Kerja</div>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="biaya_tenaga_kerja"
                                            value="{{ old('biaya_tenaga_kerja') }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label">Biaya Lainnya</div>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="biaya_lainnya"
                                            value="{{ old('biaya_lainnya') }}" step="0.01">
                                    </div>
                                    <input type="hidden" name="total_biaya" id="total_biaya">
                                    <input type="hidden" name="pendapatan_usaha_bulanan"
                                        value="{{ old('pendapatan_usaha_bulanan') }}" id="pendapatan_usaha_bulanan">
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Penerimaan Bulanan</h5>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gaji Pemohon</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="gaji_pemohon"
                                            value="{{ old('gaji_pemohon') }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gaji Pasangan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="gaji_pasangan"
                                            value="{{ old('gaji_pasangan') }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendapatan Lain</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="pendapatan_lain"
                                            value="{{ old('pendapatan_lain') }}" step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <input type="hidden" name="total_pendapatan" id="total_pendapatan"
                                        value="{{ old('total_pendapatan') }}">
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
                                        <input type="number" class="form-control" name="kebutuhan_pokok"
                                            value="{{ old('kebutuhan_pokok') }}" step="0.01" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Biaya Pendidikan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="biaya_pendidikan"
                                            step="0.01" value="{{ old('biaya_pendidikan') }}">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Pengeluaran Lainnya</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="pengeluaran_lainnya"
                                            value="{{ old('pengeluaran_lainnya') }}" step="0.01" required>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <input type="hidden" class="form-control" name="total_pengeluaran_rutin"
                                        step="0.01" value="{{ old('total_pengeluaran_rutin') }}" required>
                                    <h4 class="fw-bold text-decoration-underline"> Total Pengeluaran Rutin : <span
                                            class="total_pengeluaran_rutin"></span></h4>
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kemampuan Bayar</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="kemampuan_bayar"
                                            step="0.01" required>
                                    </div>
                                </div>
                            </div> --}}
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
                                        name="jenis_kendaraan" value="{{ old('jenis_kendaraan') }}">
                                    @error('jenis_kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Merk/Tipe</label>
                                    <input type="text"
                                        class="form-control @error('merk_tipe') is-invalid @enderror"
                                        name="merk_tipe" value="{{ old('merk_tipe') }}">
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
                                        name="nomor_polisi" value="{{ old('nomor_polisi') }}">
                                    @error('nomor_polisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tahun Pembuatan</label>
                                    <input type="text"
                                        class="form-control @error('tahun_pembuatan') is-invalid @enderror"
                                        name="tahun_pembuatan" value="{{ old('tahun_pembuatan') }}">
                                    @error('tahun_pembuatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Atas Nama</label>
                                    <input type="text"
                                        class="form-control @error('nama_pemilik') is-invalid @enderror"
                                        name="nama_pemilik" value="{{ old('nama_pemilik') }}">
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
                                        name="nomor_rangka" value="{{ old('nomor_rangka') }}">
                                    @error('nomor_rangka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Mesin</label>
                                    <input type="text"
                                        class="form-control @error('nomor_mesin') is-invalid @enderror"
                                        name="nomor_mesin" value="{{ old('nomor_mesin') }}">
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
                                        name="nomor_bpkb" value="{{ old('nomor_bpkb') }}">
                                    @error('nomor_bpkb')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hubungan dengan Anggota</label>
                                    <input type="text" class="form-control" name="hubungan_dengan_anggota"
                                        value="{{ old('hubungan_dengan_anggota') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga Pasar Kendaraan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="harga_pasar_kendaraan"
                                            value="{{ old('harga_pasar_kendaraan') }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nilai Taksasi Kendaraan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="nilai_taksasi_kendaraan"
                                            value="{{ old('nilai_taksasi_kendaraan') }}" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Kondisi Jaminan Kendaraan</label>
                                    <textarea class="form-control" name="kondisi_jaminan_kendaraan" rows="2">{{ old('kondisi_jaminan_kendaraan') }}</textarea>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Jaminan Sertifikat</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Sertifikat</label>
                                    <input type="text" class="form-control" name="jenis_sertifikat"
                                        value="{{ old('jenis_sertifikat') }}" placeholder="SHM/SHGU/SHGB">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Sertifikat</label>
                                    <input type="text" class="form-control" name="nomor_sertifikat"
                                        value="{{ old('nomor_sertifikat') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Atas Nama</label>
                                    <input type="text" class="form-control" name="pemilik_sertifikat"
                                        value="{{ old('pemilik_sertifikat') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Luas Tanah/Bangunan</label>
                                    <input type="text" class="form-control" name="luas_tanah_bangunan"
                                        value="{{ old('luas_tanah_bangunan') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor/Tanggal Ukur</label>
                                    <input type="text" class="form-control" name="nomor_tanggal_ukur"
                                        value="{{ old('nomor_tanggal_ukur') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hubungan Pemilik</label>
                                    <input type="text" class="form-control" name="hubungan_pemilik"
                                        value="{{ old('hubungan_pemilik') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga Pasar Tanah</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="harga_pasar_tanah"
                                            value="{{ old('harga_pasar_tanah') }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nilai Taksasi Tanah</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="nilai_taksasi_tanah"
                                            value="{{ old('harga_taksasi_tanah') }}" step="0.01">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Kondisi Jaminan Tanah</label>
                                    <textarea class="form-control" name="kondisi_jaminan_tanah" rows="2">{{ old('kondisi_jaminan_tanah') }}</textarea>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit"
                                    class="btn btn-primary btn-lg">{{ isset($data) ? 'Update' : 'Submit' }}
                                    Pengajuan</button>
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
                pengeluaran: {
                    inputs: ['kebutuhan_pokok', 'biaya_pendidikan', 'pengeluaran_lainnya'],
                    targetInput: 'total_pengeluaran_rutin',
                    targetSpan: 'total_pengeluaran_rutin'
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

            // Object.values(calculations).forEach(calc => {
            //     calc.inputs.forEach(input => {
            //         if ($(`input[name=${calc.targetInput}]`).val() !== '') {
            //             let value = parseFloat($(`input[name=${calc.targetInput}]`).val()) || 0;
            //             $(`.${calc.targetSpan}`).html(value.toLocaleString('id-ID', {
            //                 style: 'currency',
            //                 currency: 'IDR'
            //             }));
            //         }
            //     });
            // });

            // Tambahkan event listener untuk fungsi jumlah_pendapatan
            const pendapatanInputs = ['biaya_bahan', 'biaya_tenaga_kerja', 'biaya_lainnya', 'omset_bulanan',
                'gaji_pemohon', 'gaji_pasangan', 'pendapatan_lain'
            ];
            pendapatanInputs.forEach(input => {
                $(`input[name=${input}]`).on('input', jumlah_pendapatan);
            });
        });
    </script>
</body>

</html>
