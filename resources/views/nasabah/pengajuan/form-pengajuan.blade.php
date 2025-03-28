<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Permohonan Pembiayaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-check-label {
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <form
                    action="{{ $pengajuan ? route('nasabah.pengajuan.update', $pengajuan) : route('nasabah.pengajuan.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($pengajuan)
                        @method('PUT')
                    @endif
                    <div class="form-container">
                        <div class="form-header">
                            <h2 class="mb-3">Formulir Permohonan Pembiayaan</h2>
                            <p class="text-muted">Bismillahirrahmaanirrahim</p>
                        </div>

                        <form>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">1. Nama Lengkap</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Masukkan nama lengkap"
                                        value="{{ $nasabah->nama_lengkap }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">2. Tempat/Tanggal Lahir</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Tempat lahir"
                                        value="{{ $nasabah->tempat_lahir }}" readonly>
                                    <input type="date" class="form-control mt-2"
                                        value="{{ $nasabah->tanggal_lahir }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">3. Alamat Rumah</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" placeholder="Alamat lengkap">{{ $nasabah->alamat }}</textarea>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="RT/RW"
                                                value="{{ $nasabah->rt_rw }}">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Dusun"
                                                value="{{ $nasabah->dsn }}">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Desa"
                                                value="{{ $nasabah->ds }}">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Kecamatan"
                                                value="{{ $nasabah->kec }}">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Kabupaten"
                                                value="{{ $nasabah->kab }}">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Kode Pos"
                                                value="{{ $nasabah->kode_pos }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">4. Telepon/HP</label>
                                <div class="col-sm-8">
                                    <input type="tel" class="form-control" placeholder="Nomor telepon"
                                        value="{{ $nasabah->telephone }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">5. Agama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ $nasabah->agama }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">6. Pekerjaan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Pekerjaan saat ini"
                                        value="{{ $nasabah->pekerjaan }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">7. Alamat Kantor/Usaha</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" placeholder="Alamat lengkap kantor/usaha">{{ $nasabah->alamat_kantor_usaha }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">8. Telepon/Faximile</label>
                                <div class="col-sm-8">
                                    <input type="tel" class="form-control" placeholder="Nomor telepon kantor">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">9. Nominal yang Diajukan</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text"
                                            class="form-control @error('nominal') is-invalid @enderror" name="nominal"
                                            value="{{ old('nominal', $pengajuan->nominal_pengajuan ?? '') }}"
                                            placeholder="Nominal pembiayaan">
                                    </div>
                                    @error('nominal')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">10. Keperluan Pembiayaan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control @error('keperluan') is-invalid @enderror" rows="3" name="keperluan"
                                        placeholder="Tujuan pengajuan pembiayaan">{{ old('keperluan', $pengajuan->keperluan ?? '') }}</textarea>
                                    @error('keperluan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">11. Jangka Waktu</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <select name="jangka_waktu" id="jangka_waktu"
                                            class="form-control @error('jangka_waktu') is-invalid @enderror" required>
                                            <option value="3">3 Bulan</option>
                                            <option value="12">12 Bulan</option>
                                            <option value="24">24 Bulan</option>
                                            <option value="36">36 Bulan</option>
                                        </select>
                                        <span class="input-group-text">Bulan</span>
                                    </div>
                                    @error('jangka_waktu')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">12. Jaminan yang Diajukan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('jaminan') is-invalid @enderror"
                                        name="jaminan" value="{{ old('jaminan', $pengajuan->jaminan ?? '') }}"
                                        placeholder="Detail jaminan">
                                    @error('jaminan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">13. Ahli Waris</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control @error('ahli_waris') is-invalid @enderror"
                                        name="ahli_waris"
                                        value="{{ old('ahli_waris', $pengajuan->ahli_waris ?? '') }}"
                                        placeholder="Nama ahli waris">
                                    @error('ahli_waris')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">14. Nama Pemilik Jaminan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="pemilik_jaminan"
                                        class="form-control @error('pemilik_jaminan') is-invalid @enderror"
                                        value="{{ old('pemilik_jaminan', $pengajuan->nama_pemilik_jaminan ?? '') }}"
                                        placeholder="Nama pemilik jaminan">
                                    @error('pemilik_jaminan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dokumen" class="col-form-label col-sm-4">15. Upload Dokumen</label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('dokumen') is-invalid @enderror" type="file"
                                        name="dokumen" id="dokumen" placeholder="Dokumen lainnya">
                                    @isset($pengajuan)
                                        <small><a href="{{ asset('storage/dokumen/' . $pengajuan->dokumen_pendukung) }}"
                                                target="_blank">Dokumen Pendukung</a></small>
                                    @endisset
                                    @error('dokumen')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <h5>Dokumen Pendukung</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="ktpCheck">
                                    <label class="form-check-label" for="ktpCheck">
                                        Fotocopy KTP Suami Istri 2 lembar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="nikahCheck">
                                    <label class="form-check-label" for="nikahCheck">
                                        Fotocopy Buku Nikah 2 lembar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="kkCheck">
                                    <label class="form-check-label" for="kkCheck">
                                        Fotocopy Kartu Keluarga 2 lembar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="jaminanCheck">
                                    <label class="form-check-label" for="jaminanCheck">
                                        Fotocopy Surat Jaminan 2 berkas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="usahaCheck">
                                    <label class="form-check-label" for="usahaCheck">
                                        Fotocopy Surat Keterangan Usaha 1 berkas
                                    </label>
                                </div>
                            </div>

                            <div class="alert alert-info" role="alert">
                                Saya menyatakan bahwa semua data dan informasi yang diberikan adalah benar.
                                Informasi ini diberikan untuk tujuan permohonan pembiayaan dan dengan ini saya
                                mengijinkan KSPPS BMT NU JOMBANG untuk mendapatkan dan memeriksa seluruh
                                informasi yang diperlukan.
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agreementCheck" required>
                                <label class="form-check-label" for="agreementCheck">
                                    Saya menyetujui persyaratan dan bersedia mematuhi peraturan KSPPS BMT NU JOMBANG
                                </label>
                            </div>

                            {{-- <div class="mt-4">
                                <h4>Pertimbangan Layanan Team Layanan Pembiayaan</h4>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Pembiayaan yang Disetujui</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" class="form-control"
                                                placeholder="Nominal pembiayaan disetujui">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Angsuran</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" placeholder="Jumlah angsuran">
                                            <span class="input-group-text">X</span>
                                            <input type="number" class="form-control" placeholder="Periode">
                                            <span class="input-group-text">@</span>
                                            <div class="input-group-text">Rp</div>
                                            <input type="text" class="form-control"
                                                placeholder="Nominal per angsuran">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Angsuran Margin</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control"
                                                placeholder="Jumlah angsuran margin">
                                            <span class="input-group-text">X</span>
                                            <input type="number" class="form-control" placeholder="Periode">
                                            <span class="input-group-text">@</span>
                                            <div class="input-group-text">Rp</div>
                                            <input type="text" class="form-control"
                                                placeholder="Nominal margin per angsuran">
                                            <span class="input-group-text">=</span>
                                            <div class="input-group-text">Rp</div>
                                            <input type="text" class="form-control" placeholder="Total margin">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>AO</label>
                                            <input type="text" class="form-control" placeholder="AO">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Diperiksa</label>
                                            <input type="text" class="form-control" placeholder="Diperiksa">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Disetujui</label>
                                            <input type="text" class="form-control" placeholder="Disetujui">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Legal</label>
                                            <input type="text" class="form-control" placeholder="Legal">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Pimpinan Cabang</label>
                                            <input type="text" class="form-control" placeholder="Pimpinan Cabang">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <small class="text-muted">Jombang, {{ date('d-m-Y') }}</small>
                                </div>
                            </div> --}}

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    {{ $pengajuan ? 'Update Permohonan' : 'Ajukan Permohonan' }}
                                </button>
                                <a href="{{ route('nasabah.pengajuan.index') }}"
                                    class="btn btn-secondary mt-2">Batal</a>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <small class="text-muted">Wassalamu'alaikum Warahmatullahi Wabarakatuh</small>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
