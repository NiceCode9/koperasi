<x-layoutAdmin>
    <div class="jabatan1">
        <h4 class="fw-bold" style="margin-bottom: 20px">Form Edit News</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="edit">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control input" id="judul" name="judul" value="{{ $news->judul }}" required>
                </div>
                <div class="form-group">
                    <label for="tgl">Tanggal</label>
                    <input type="date" class="form-control input" id="tgl" name="tgl" value="{{ $news->tgl }}" required>
                </div>
                <div class="form-group">
                    <label for="isi">Isi</label>
                    <textarea class="form-control input" id="isi" name="isi" rows="10" cols="50" required>{!! $news->isi !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Upload Gambar <span class="text-danger">(kosongkan jika tidak ingin mengubah)</span></label>
                    <input type="file" class="form-control input" id="image" name="image">
                    @if(isset($news['image']))
                        <img src="{{ asset('poster/' . $news['image']) }}" alt="Gambar News" style="width: 150px; margin-bottom: 10px;">
                        <p>{{ basename($news['image']) }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('berita.index') }}" class="btn btn-success">Kembali</a>
            </div>
        </form>
    </div>
</x-layoutAdmin>