@extends('components.app', ['title' => 'Dashboard Nasabah'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Stats Cards -->
            <div class="col-md-3 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Pengajuan</h5>
                        <h2 class="mb-0">{{ $stats['total_pengajuan'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Aktif</h5>
                        <h2 class="mb-0">{{ $stats['pengajuan_aktif'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Lunas</h5>
                        <h2 class="mb-0">{{ $stats['pengajuan_lunas'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Terlambat</h5>
                        <h2 class="mb-0">{{ $stats['angsuran_terlambat'] }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Pengajuan -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Pengajuan Terakhir</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentPengajuan as $pengajuan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pengajuan->nomor_pengajuan }}</td>
                                            <td>Rp {{ number_format($pengajuan->nominal_pengajuan, 0, ',', '.') }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $pengajuan->status_pembayaran === 'lunas' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $pengajuan->status_pembayaran === 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Angsuran -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Angsuran Mendatang</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Pengajuan</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($upcomingAngsuran as $angsuran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $angsuran->pengajuan->nomor_pengajuan }}</td>
                                            <td>
                                                <span
                                                    class="d-block">{{ \Carbon\Carbon::parse($angsuran->tanggal_jatuh_tempo)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                                                <small
                                                    class="text-muted">{{ \Carbon\Carbon::parse($angsuran->tanggal_jatuh_tempo)->diffForHumans() }}</small>
                                            </td>
                                            <td>Rp {{ number_format($angsuran->jumlah_angsuran, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Section -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Progres Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($recentPengajuan as $pengajuan)
                            <div class="mb-4">
                                <h6>Pengajuan #{{ $pengajuan->nomor_pengajuan }}</h6>
                                <div class="progress" style="height: 25px;">
                                    @php
                                        $percentage =
                                            ($pengajuan->angsurans()->where('status', 'paid')->count() /
                                                $pengajuan->angsurans()->count()) *
                                            100;
                                    @endphp
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                        {{ round($percentage) }}%
                                        ({{ $pengajuan->angsurans()->where('status', 'paid')->count() }}/{{ $pengajuan->angsurans()->count() }})
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .progress {
            background-color: #e9ecef;
            border-radius: 0.25rem;
        }

        .progress-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }
    </style>
@endpush
