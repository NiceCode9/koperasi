@extends('components.app', ['title' => 'Data Nasabah'])
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Data Nasabah</h4>
                <a href="{{ route('admin.nasabah.create') }}" class="btn btn-primary btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Tambah Nasabah
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="nasabah-table" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                            <th>Telephone</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nasabah as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->telephone }}</td>
                                <td>
                                    @if ($item->dsn || $item->rt_rw || $item->ds || $item->kec || $item->kab)
                                        {{ $item->dsn ? 'Dsn. ' . $item->dsn : '' }}
                                        {{ $item->rt_rw ? 'RT/RW ' . $item->rt_rw : '' }}<br>
                                        {{ $item->ds ? 'Ds. ' . $item->ds : '' }}
                                        {{ $item->kec ? 'Kec. ' . $item->kec : '' }}<br>
                                        {{ $item->kab ? 'Kab. ' . $item->kab : '' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->status_perkawinan ?? '-' }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.nasabah.show', $item->id) }}"
                                            class="btn btn-info btn-sm mr-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.nasabah.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm mr-1">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.nasabah.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#nasabah-table').DataTable();
        });
    </script>
@endpush
