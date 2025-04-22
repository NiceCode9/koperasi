@extends('components.app', ['title' => 'Pembayaran Angsuran'])

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Angsuran</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nomor Angsuran</th>
                            <td>{{ $angsuran->nomor_angsuran }}</td>
                        </tr>
                        <tr>
                            <th>Nasabah</th>
                            <td>{{ $angsuran->pengajuan->nasabah->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Jatuh Tempo</th>
                            <td>{{ Carbon\Carbon::parse($angsuran->tanggal_jatuh_tempo)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>Rp {{ number_format($angsuran->jumlah_angsuran, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $angsuran->status_label['class'] }}">
                                    {{ $angsuran->status_label['label'] }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Pembayaran</h3>
                </div>
                <form action="{{ route('admin.angsuran.store', $angsuran) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>Jatuh Tempo:</strong>
                            {{ Carbon\Carbon::parse($angsuran->tanggal_jatuh_tempo)->format('d F Y') }}
                        </div>
                        <div class="form-group">
                            <label>Tanggal Bayar</label>
                            <input type="date" name="tanggal_bayar" class="form-control"
                                value="{{ old('tanggal_bayar', now()->format('Y-m-d')) }}" required
                                max="{{ now()->format('Y-m-d') }}"> <!-- Batasi tidak boleh memilih tanggal future -->
                            {{-- <input type="hidden" name="denda" value="0"> --}}
                        </div>
                        <div class="form-group">
                            <label>Denda (Jika ada)</label>
                            <input type="number" name="denda" class="form-control" value="{{ old('denda', 0) }}"
                                min="0" readonly>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Pembayaran
                        </button>
                        <a href="{{ route('admin.angsuran.index') }}" class="btn btn-default">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalBayarInput = document.querySelector('input[name="tanggal_bayar"]');
            const dendaInput = document.querySelector('input[name="denda"]');
            const jatuhTempo = '{{ Carbon\Carbon::parse($angsuran->tanggal_jatuh_tempo)->format('Y-m-d') }}';
            const tanggalDefault = tanggalBayarInput.value; // Ambil nilai default

            // Fungsi untuk cek keterlambatan
            const checkKeterlambatan = (selectedDate) => {
                if (new Date(selectedDate) > new Date(jatuhTempo)) {
                    const diffTime = Math.abs(new Date(selectedDate) - new Date(jatuhTempo));
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    // const denda = diffDays * {{ config('angsuran.denda_per_hari') }};
                    const denda = diffDays * 10000;
                    dendaInput.value = denda;

                    Swal.fire({
                        icon: 'warning',
                        title: 'Pembayaran Terlambat',
                        html: `Telat <b>${diffDays} hari</b>. Denda otomatis: <b>Rp ${denda.toLocaleString('id-ID')}</b>`,
                        confirmButtonText: 'Mengerti'
                    });
                }
            };

            // Pengecekan saat pertama kali load
            checkKeterlambatan(tanggalDefault);

            // Pengecekan saat tanggal diubah
            tanggalBayarInput.addEventListener('change', function() {
                checkKeterlambatan(this.value);
            });
        });
    </script>
@endpush
