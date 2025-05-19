@extends('components.app', ['title' => 'Dashboard Admin'])


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
                        <h5 class="card-title">Pengajuan Baru</h5>
                        <h2 class="mb-0">{{ $stats['pengajuan_baru'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Disetujui</h5>
                        <h2 class="mb-0">{{ $stats['pengajuan_disetujui'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Ditolak</h5>
                        <h2 class="mb-0">{{ $stats['pengajuan_ditolak'] }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Pengajuan -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Pengajuan Terbaru</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nasabah</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentPengajuan as $pengajuan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pengajuan->nasabah->nama_lengkap }}</td>
                                            <td>Rp {{ number_format($pengajuan->nominal_pengajuan, 0, ',', '.') }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $pengajuan->status === 'approved' ? 'bg-success' : ($pengajuan->status === 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                                    {{ ucfirst($pengajuan->status) }}
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

            <!-- Recent Angsuran -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Pembayaran Terbaru</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nasabah</th>
                                        <th>Nominal</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentAngsuran as $angsuran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $angsuran->pengajuan->nasabah->nama_lengkap }}</td>
                                            <td>Rp {{ number_format($angsuran->jumlah_angsuran, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($angsuran->tanggal_bayar)->locale('id')->isoFormat('D MMMM YYYY') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Statistik Pengajuan</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="pengajuanChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Statistik Angsuran</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="angsuranChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Pengajuan Bulanan</h5>
                        <div>
                            <select id="yearFilter" class="form-select form-select-sm" onchange="this.form.submit()">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pengajuan Chart
            const pengajuanCtx = document.getElementById('pengajuanChart').getContext('2d');
            new Chart(pengajuanCtx, {
                type: 'bar',
                data: {
                    labels: ['Disetujui', 'Ditolak', 'Proses'],
                    datasets: [{
                        label: 'Status Pengajuan',
                        data: [
                            {{ $stats['pengajuan_disetujui'] }},
                            {{ $stats['pengajuan_ditolak'] }},
                            {{ $stats['pengajuan_baru'] }}
                        ],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.7)',
                            'rgba(220, 53, 69, 0.7)',
                            'rgba(255, 193, 7, 0.7)'
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(220, 53, 69, 1)',
                            'rgba(255, 193, 7, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Angsuran Chart
            const angsuranCtx = document.getElementById('angsuranChart').getContext('2d');
            new Chart(angsuranCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Tepat Waktu', 'Terlambat'],
                    datasets: [{
                        data: [
                            {{ $stats['total_pengajuan'] - $stats['angsuran_terlambat'] }},
                            {{ $stats['angsuran_terlambat'] }}
                        ],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.7)',
                            'rgba(255, 193, 7, 0.7)'
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(255, 193, 7, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Monthly Chart
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                        'September', 'Oktober', 'November', 'Desember'
                    ],
                    datasets: [{
                        label: 'Total Nominal Pengajuan (Rp)',
                        data: @json(array_values($monthlyData)),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Total Nominal Pengajuan Bulanan Tahun ' + {{ $currentYear }}
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    }
                }
            });

            // Year Filter Handler
            document.getElementById('yearFilter').addEventListener('change', function() {
                window.location.href = '{{ route('dashboard') }}?year=' + this.value;
            });
        });
    </script>
@endpush
