@extends('components.app', ['title' => 'Riwayat Survei'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Riwayat Survei {{ auth()->user()->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="history-survei-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Nasabah</th>
                                    <th>Tanggal Survei</th>
                                    <th>Status</th>
                                    <th>
                                        <i class="fas fa-cogs"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->pengajuan->nasabah->nama_lengkap }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_survei)->locale('id')->isoFormat('DD MMMM YYYY') }}
                                        </td>
                                        <td>
                                            @php
                                                $status = [
                                                    'diperiksa' => 'info',
                                                    'diterima' => 'success',
                                                    'ditolak' => 'danger',
                                                ];
                                            @endphp
                                            <span class="badge badge-{{ $status[$item->status_aplikasi] ?? 'secondary' }}">
                                                {{ ucfirst($item->status_aplikasi) }}
                                        </td>
                                        <td>
                                            @if ($item->status_aplikasi == 'diajukan')
                                                <a href="{{ route('marketing.riwayat.survei.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm btn-edit">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="" method="POST"
                                                    onsubmit="return confirm('Yakin hapus data?')" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <a href="" class="btn btn-sm btn-info btn-detail">
                                                    <i class="fas fa-circle-info"></i> Detail
                                                </a>
                                            @endif
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#history-survei-table').DataTable({
                "responsive": true,
                "autoWidth": false,
                "lengthChange": false,
                "pageLength": 10,
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_ total entri)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "<i class='fas fa-angle-double-left'></i>",
                        "last": "<i class='fas fa-angle-double-right'></i>",
                        "next": "<i class='fas fa-angle-right'></i>",
                        "previous": "<i class='fas fa-angle-left'></i>"
                    }
                }
            });
        });
    </script>
@endpush
