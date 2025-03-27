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
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="mb-3">Formulir Permohonan Pembiayaan</h2>
                        <p class="text-muted">Bismillahirrahmaanirrahim</p>
                    </div>

                    <form>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">1. Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">2. Tempat/Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Tempat lahir">
                                <input type="date" class="form-control mt-2">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">3. Alamat Rumah</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" placeholder="Alamat lengkap"></textarea>
                                <div class="row mt-2">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="RT/RW">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Dusun">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Desa">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Kecamatan">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Kabupaten">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Kode Pos">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">4. Telepon/HP</label>
                            <div class="col-sm-8">
                                <input type="tel" class="form-control" placeholder="Nomor telepon">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">5. Agama</label>
                            <div class="col-sm-8">
                                <select class="form-select">
                                    <option selected>Pilih Agama</option>
                                    <option>Islam</option>
                                    <option>Kristen</option>
                                    <option>Katholik</option>
                                    <option>Hindu</option>
                                    <option>Buddha</option>
                                    <option>Konghucu</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">6. Pekerjaan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Pekerjaan saat ini">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">7. Alamat Kantor/Usaha</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" placeholder="Alamat lengkap kantor/usaha"></textarea>
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
                                    <input type="text" class="form-control" placeholder="Nominal pembiayaan">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">10. Keperluan Pembiayaan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" placeholder="Tujuan pengajuan pembiayaan"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">11. Jangka Waktu</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Jangka waktu">
                                    <span class="input-group-text">Bulan</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">12. Jaminan yang Diajukan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Detail jaminan">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">13. Ahli Waris</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Nama ahli waris">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">14. Nama Pemilik Jaminan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Nama pemilik jaminan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="dokumen" class="col-form-label col-sm-4">15. Upload Dokumen</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="file" name="dokumen" id="dokumen"
                                    placeholder="Dokumen lainnya">
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

                        <div class="mt-4">
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
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Ajukan Permohonan</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">Wassalamu'alaikum Warahmatullahi Wabarakatuh</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
