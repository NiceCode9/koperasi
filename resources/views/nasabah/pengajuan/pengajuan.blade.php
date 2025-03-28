@extends('components.app', ['title' => 'Pengajuan Peminjaman'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Data Pengajuan</h4>
                        <a href="{{ route('nasabah.pengajuan.form') }}" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-plus"></i>
                            Buat Pengajuan
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="pengajuan-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Jumlah Pengajuan</th>
                                    <th>Jumlah Disetujui</th>
                                    <th>Jumlah Angsuran (Bulan)</th>
                                    <th>Status</th>
                                    <th>
                                        <i class="fas fa-cogs"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->locale('id')->isoFormat('D MMMM YYYY') }}
                                        </td>
                                        <td>Rp. {{ number_format($item->nominal_pengajuan, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($item->nominal_disetujui, 0, ',', '.') ?? '-' }}</td>
                                        <td>Rp. {{ number_format($item->angsuran, 0, ',', '.') ?? '-' }}</td>
                                        <td>
                                            @php
                                                $status = [
                                                    'pending' => 'warning',
                                                    'survei' => 'info',
                                                    'accepted' => 'success',
                                                    'rejected' => 'danger',
                                                ];
                                            @endphp
                                            <span class="badge badge-{{ $status[$item->status] ?? 'secondary' }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <a href="{{ route('nasabah.pengajuan.form.edit', $item->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('nasabah.pengajuan.destroy', $item->id) }}"
                                                    method="POST" onsubmit="return confirm('Yakin hapus data?')"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
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
