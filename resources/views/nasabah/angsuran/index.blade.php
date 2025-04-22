@extends('components.app', ['title' => 'Daftar Angsuran Saya'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" id="pengajuan-tabs" role="tablist">
                        @foreach ($pengajuan as $peng)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $peng->id }}-tab"
                                    data-toggle="tab" data-target="#tab-{{ $peng->id }}" type="button" role="tab"
                                    aria-controls="tab-{{ $peng->id }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
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
                        @foreach ($pengajuan as $peng)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $peng->id }}"
                                role="tabpanel" aria-labelledby="tab-{{ $peng->id }}-tab">

                                @include('nasabah.angsuran._partials.angsuran_table', [
                                    'angsurans' => $peng->angsurans()->paginate(5),
                                ])
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
            // Inisialisasi tab Bootstrap
            const tabElms = document.querySelectorAll('button[data-toggle="tab"]');
            tabElms.forEach(tabEl => {
                tabEl.addEventListener('click', function(event) {
                    const tabTrigger = new bootstrap.Tab(this);
                    tabTrigger.show();
                });
            });
        });
    </script>
@endpush
