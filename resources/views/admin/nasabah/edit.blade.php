@extends('components.app', ['title' => 'Form Edit Nasabah'])
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit Nasabah</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.nasabah.update', $nasabah->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $nasabah->user_id }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto</label>
                            @if ($nasabah->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $nasabah->foto) }}" alt="Foto Nasabah"
                                        class="img-thumbnail" style="max-height: 200px">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto"
                                accept="image/*">
                            <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                name="nama_lengkap" value="{{ old('nama_lengkap', $nasabah->nama_lengkap) }}">
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                value="{{ old('nik', $nasabah->nik) }}">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Telephone</label>
                            <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                                name="telephone" value="{{ old('telephone', $nasabah->telephone) }}">
                            @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', $nasabah->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                name="tempat_lahir" value="{{ old('tempat_lahir', $nasabah->tempat_lahir) }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                name="tanggal_lahir" value="{{ old('tanggal_lahir', $nasabah->tanggal_lahir) }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L"
                                    {{ old('jenis_kelamin', $nasabah->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P"
                                    {{ old('jenis_kelamin', $nasabah->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" class="form-control" name="pekerjaan"
                                value="{{ old('pekerjaan', $nasabah->pekerjaan) }}">
                        </div>
                        <div class="form-group">
                            <label>Alamat Kantor/Usaha</label>
                            <textarea class="form-control" name="alamat_kantor_usaha" rows="2">{{ old('alamat_kantor_usaha', $nasabah->alamat_kantor_usaha) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" class="form-control">
                                <option value="">Pilih Agama</option>
                                @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                    <option value="{{ $agama }}"
                                        {{ old('agama', $nasabah->agama) == $agama ? 'selected' : '' }}>
                                        {{ $agama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status Perkawinan</label>
                            <select name="status_perkawinan" class="form-control">
                                <option value="">Pilih Status</option>
                                @foreach (['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status_perkawinan', $nasabah->status_perkawinan) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4>Detail Alamat</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>RT/RW</label>
                            <input type="text" class="form-control" name="rt_rw"
                                value="{{ old('rt_rw', $nasabah->rt_rw) }}" placeholder="000/000">
                        </div>
                        <div class="form-group">
                            <label>Dusun</label>
                            <input type="text" class="form-control" name="dsn"
                                value="{{ old('dsn', $nasabah->dsn) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Desa</label>
                            <input type="text" class="form-control" name="ds"
                                value="{{ old('ds', $nasabah->ds) }}">
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control" name="kec"
                                value="{{ old('kec', $nasabah->kec) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <input type="text" class="form-control" name="kab"
                                value="{{ old('kab', $nasabah->kab) }}">
                        </div>
                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input type="text" class="form-control" name="kode_pos"
                                value="{{ old('kode_pos', $nasabah->kode_pos) }}">
                        </div>
                    </div>
                </div>

                <div class="card-action">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('admin.nasabah.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
