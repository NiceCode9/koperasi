@extends('components.app', ['title' => 'Profile'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profile Nasabah</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('nasabah.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                @if (isset($nasabah) && $nasabah->foto)
                                    <img src="{{ asset('storage/' . $nasabah->foto) }}" class="mt-2"
                                        style="max-width: 200px">
                                @endif
                                <div class="form-group">
                                    <label>Foto Profile</label>
                                    <input type="file" class="form-control" name="foto" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama_lengkap"
                                        value="{{ old('nama_lengkap', $nasabah->nama_lengkap ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" class="form-control" name="nik"
                                        value="{{ old('nik', $nasabah->nik ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', $nasabah->email ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Telephone</label>
                                    <input type="text" class="form-control" name="telephone"
                                        value="{{ old('telephone', $nasabah->telephone ?? '') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir"
                                        value="{{ old('tempat_lahir', $nasabah->tempat_lahir ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $nasabah->tanggal_lahir ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L"
                                            {{ old('jenis_kelamin', $nasabah->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="P"
                                            {{ old('jenis_kelamin', $nasabah->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan"
                                        value="{{ old('pekerjaan', $nasabah->pekerjaan ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat Kantor/Usaha</label>
                                    <textarea class="form-control" name="alamat_kantor_usaha" rows="2" required>{{ old('alamat_kantor_usaha', $nasabah->alamat_kantor_usaha ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select class="form-control" name="agama" required>
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam"
                                            {{ old('agama', $nasabah->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Kristen"
                                            {{ old('agama', $nasabah->agama ?? '') == 'Kristen' ? 'selected' : '' }}>
                                            Kristen</option>
                                        <option value="Katolik"
                                            {{ old('agama', $nasabah->agama ?? '') == 'Katolik' ? 'selected' : '' }}>
                                            Katolik</option>
                                        <option value="Hindu"
                                            {{ old('agama', $nasabah->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Buddha"
                                            {{ old('agama', $nasabah->agama ?? '') == 'Buddha' ? 'selected' : '' }}>
                                            Buddha</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>RT/RW</label>
                                    <input type="text" class="form-control" name="rt_rw"
                                        value="{{ old('rt_rw', $nasabah->rt_rw ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Dusun</label>
                                    <input type="text" class="form-control" name="dsn"
                                        value="{{ old('dsn', $nasabah->dsn ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Desa</label>
                                    <input type="text" class="form-control" name="ds"
                                        value="{{ old('ds', $nasabah->ds ?? '') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control" name="kec"
                                        value="{{ old('kec', $nasabah->kec ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Kabupaten</label>
                                    <input type="text" class="form-control" name="kab"
                                        value="{{ old('kab', $nasabah->kab ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input type="text" class="form-control" name="kode_pos"
                                        value="{{ old('kode_pos', $nasabah->kode_pos ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Status Perkawinan</label>
                                    <select class="form-control" name="status_perkawinan" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Belum Kawin"
                                            {{ old('status_perkawinan', $nasabah->status_perkawinan ?? '') == 'Belum Kawin' ? 'selected' : '' }}>
                                            Belum Kawin</option>
                                        <option value="Kawin"
                                            {{ old('status_perkawinan', $nasabah->status_perkawinan ?? '') == 'Kawin' ? 'selected' : '' }}>
                                            Kawin</option>
                                        <option value="Cerai Hidup"
                                            {{ old('status_perkawinan', $nasabah->status_perkawinan ?? '') == 'Cerai Hidup' ? 'selected' : '' }}>
                                            Cerai Hidup</option>
                                        <option value="Cerai Mati"
                                            {{ old('status_perkawinan', $nasabah->status_perkawinan ?? '') == 'Cerai Mati' ? 'selected' : '' }}>
                                            Cerai Mati</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-primary">Simpan Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
