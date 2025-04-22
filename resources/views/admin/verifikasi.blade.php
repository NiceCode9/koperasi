@extends('components.app', ['title' => 'Verifikasi Pengajuan'])

@push('style')
    <style>
        #form-accepted {
            transition: all 0.3s ease;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Verifikasi Pengajuan</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Data Nasabah</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $pengajuan->nasabah->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Pengajuan</th>
                                    <td>{{ $pengajuan->nomor_pengajuan }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Pengajuan</th>
                                    <td>Rp {{ number_format($pengajuan->nominal_pengajuan, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Hasil Survei</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Plafon Disetujui</th>
                                    <td>Rp {{ number_format($pengajuan->survei->plafon_disetujui ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Jangka Waktu</th>
                                    <td>{{ $pengajuan->survei->jangka_waktu_disetujui ?? 0 }} Bulan</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <form action="{{ route('admin.pengajuan.verifikasi.proses', $pengajuan->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Status Verifikasi</label>
                            <select name="status" class="form-control" id="status-verifikasi" required>
                                <option value="">Pilih Status</option>
                                <option value="accepted">Setujui</option>
                                <option value="rejected">Tolak</option>
                            </select>
                        </div>

                        <div id="form-accepted">
                            <div class="form-group">
                                <label>Nominal Disetujui</label>
                                <input type="number" name="nominal_disetujui" class="form-control"
                                    value="{{ $pengajuan->survei->plafon_disetujui ?? $pengajuan->nominal_pengajuan }}">
                            </div>
                            <div class="form-group">
                                <label>Jumlah Angsuran (Bulan)</label>
                                <input type="number" name="angsuran" class="form-control"
                                    value="{{ $pengajuan->survei->jangka_waktu_disetujui ?? $pengajuan->jangka_waktu }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Verifikasi</button>
                        <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Sembunyikan form accepted awalnya
            $('#form-accepted').hide();

            // Tampilkan/sembunyikan berdasarkan status
            $('#status-verifikasi').change(function() {
                if ($(this).val() == 'accepted') {
                    $('#form-accepted').show();
                } else {
                    $('#form-accepted').hide();
                }
            });
        });
    </script>
@endpush
