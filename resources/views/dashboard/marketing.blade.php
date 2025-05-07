@extends('components.app', ['title' => 'Dashboard'])

@section('content')
    <div class="row">
        <!-- Stats Cards -->
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Survei Anda</h5>
                    <h2 class="mb-0">{{ $stats['pengajuan_disurvei'] }}</h2>
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
                    <h5 class="card-title">Pengajuan Diterima</h5>
                    <h2 class="mb-0">{{ $stats['pengajuan_diterima'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Pengajuan Ditolak</h5>
                    <h2 class="mb-0">{{ $stats['pengajuan_ditolak'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Pengajuan per Bulan ({{ now()->year }})</h5>
                    <canvas id="monthlySubmissionsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('monthlySubmissionsChart').getContext('2d');
            const monthlySubmissions = @json($monthlySubmissions);

            const labels = Array.from({
                length: 12
            }, (_, i) => new Date(0, i).toLocaleString('default', {
                month: 'long'
            }));
            const data = labels.map((_, i) => monthlySubmissions[i + 1] || 0);

            const backgroundColors = [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(199, 199, 199, 0.5)',
                'rgba(83, 102, 255, 0.5)',
                'rgba(255, 99, 71, 0.5)',
                'rgba(60, 179, 113, 0.5)',
                'rgba(123, 104, 238, 0.5)',
                'rgba(255, 215, 0, 0.5)'
            ];

            const borderColors = backgroundColors.map(color => color.replace('0.5', '1'));

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pengajuan',
                        data: data,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
