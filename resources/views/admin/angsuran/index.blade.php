@extends('components.app', ['title' => 'Daftar Angsuran'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Filter Data</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.angsuran.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="Cari..."
                                    value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Belum Bayar
                                    </option>
                                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas
                                    </option>
                                    <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Terlambat
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ request('start_date') }}" placeholder="Dari Tanggal" min="2000-01-01">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}"
                                    placeholder="Sampai Tanggal">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Angsuran</th>
                                    <th>Nasabah</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($angsurans as $angsuran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $angsuran->nomor_angsuran }}</td>
                                        <td>{{ $angsuran->pengajuan->nasabah->nama_lengkap }}</td>
                                        <td>{{ Carbon\Carbon::parse($angsuran->tanggal_jatuh_tempo)->format('d/m/Y') }}
                                        </td>
                                        <td>Rp {{ number_format($angsuran->jumlah_angsuran, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge {{ $angsuran->status_label['class'] }}">
                                                {{ $angsuran->status_label['label'] }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($angsuran->status == 'unpaid' || $angsuran->status == 'late')
                                                <a href="{{ route('admin.angsuran.create', $angsuran) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-money-bill-wave"></i> Bayar
                                                </a>
                                            @else
                                                <span class="text-muted">Sudah dibayar</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $angsurans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
