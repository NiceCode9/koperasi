<x-layoutAdmin>
    <div class="jabatan1">
        <h4 class="fw-bold" style="margin-bottom: 20px">Form Tambah News</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="edit">
                <div class="form-group">
                    <label for="judul">Judul <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input" id="judul" name="judul" required>
                </div>
                <div class="form-group">
                    <label for="tgl">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" class="form-control input" id="tgl" name="tgl" required>
                </div>
                <div class="form-group">
                    <label for="image">Gambar <span class="text-danger">*</span></label>
                    <input type="file" class="form-control input" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="isi">Isi <span class="text-danger">*</span></label>
                    <textarea class="form-control input" id="isi" name="isi" rows="10" cols="50" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('berita.index') }}" class="btn btn-success">Kembali</a>
            </div>
        </form>
    </div>
</x-layoutAdmin>