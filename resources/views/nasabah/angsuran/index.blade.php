@extends('components.app', ['title' => 'Daftar Angsuran Saya'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" id="pengajuan-tabs" role="tablist">
                        @foreach ($pengajuan as $index => $peng)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}" id="tab-{{ $peng->id }}-tab"
                                    data-bs-toggle="tab" data-bs-target="#tab-{{ $peng->id }}" type="button"
                                    role="tab" aria-controls="tab-{{ $peng->id }}"
                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                    Pengajuan #{{ $peng->nomor_pengajuan }}
                                    <span class="badge {{ $peng->isLunas() ? 'bg-success' : 'bg-warning' }} ml-2">
                                        {{ $peng->isLunas() ? 'LUNAS' : 'BELUM LUNAS' }}
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="pengajuan-tabsContent">
                        @foreach ($pengajuan as $index => $peng)
                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="tab-{{ $peng->id }}"
                                role="tabpanel" aria-labelledby="tab-{{ $peng->id }}-tab">

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>No</th>
                                                <th>Nomor Angsuran</th>
                                                <th>Jatuh Tempo</th>
                                                <th>Status</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($peng->angsurans as $index => $angsuran)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $angsuran->nomor_angsuran }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($angsuran->tanggal_jatuh_tempo)->format('d/m/Y') }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $angsuran->status === 'paid' ? 'bg-success' : ($angsuran->status === 'late' ? 'bg-warning' : 'bg-danger') }}">
                                                            @if ($angsuran->status === 'paid')
                                                                Lunas
                                                            @elseif($angsuran->status === 'late')
                                                                Terlambat
                                                            @else
                                                                Belum Bayar
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>Rp {{ number_format($angsuran->jumlah_angsuran, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Tidak ada data angsuran</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .nav-tabs .nav-link {
            cursor: pointer;
            border: none;
            border-bottom: 3px solid transparent;
            padding: 0.75rem 1.25rem;
            color: #6c757d;
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom-color: #0d6efd;
            background-color: transparent;
        }

        .nav-tabs .nav-link:hover:not(.active) {
            border-bottom-color: #dee2e6;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi tab Bootstrap 5
            const triggerTabList = [].slice.call(document.querySelectorAll('#pengajuan-tabs button'));
            triggerTabList.forEach(function(triggerEl) {
                const tabTrigger = new bootstrap.Tab(triggerEl);

                triggerEl.addEventListener('click', function(event) {
                    event.preventDefault();
                    tabTrigger.show();
                });
            });
        });
    </script>
@endpush
