@extends('components.app', ['title' => 'Detail Nasabah'])
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Nasabah</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-4 text-center">
                    @php
                        $path = $nasabah->foto
                            ? asset('storage/' . $nasabah->foto)
                            : asset('assets/img/default-user.jpg');
                    @endphp
                    <img src="{{ $path }}" alt="Foto {{ $nasabah->nama_lengkap }}" class="img-thumbnail"
                        style="max-height: 300px">
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th width="35%">Nama Lengkap</th>
                            <td>: {{ $nasabah->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>: {{ $nasabah->nik }}</td>
                        </tr>
                        <tr>
                            <th>Telephone</th>
                            <td>: {{ $nasabah->telephone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $nasabah->email }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>: {{ $nasabah->tempat_lahir }}, {{ date('d/m/Y', strtotime($nasabah->tanggal_lahir)) }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>: {{ $nasabah->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>: {{ $nasabah->agama }}</td>
                        </tr>
                        <tr>
                            <th>Status Perkawinan</th>
                            <td>: {{ $nasabah->status_perkawinan }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th width="35%">Pekerjaan</th>
                            <td>: {{ $nasabah->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Kantor/Usaha</th>
                            <td>: {{ $nasabah->alamat_kantor_usaha }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: Dsn. {{ $nasabah->dsn }}, RT/RW {{ $nasabah->rt_rw }}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>&nbsp; Ds. {{ $nasabah->ds }}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>&nbsp; Kec. {{ $nasabah->kec }}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>&nbsp; Kab. {{ $nasabah->kab }}</td>
                        </tr>
                        <tr>
                            <th>Kode Pos</th>
                            <td>: {{ $nasabah->kode_pos }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card-action">
                <a href="{{ route('admin.nasabah.index') }}" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
@endsection
