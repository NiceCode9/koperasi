<x-layoutAdmin>
    <div class="jabatan1">
        <h2 class="fw-bold mt-3">Kelola News</h2>
        <div class="adminB">
            <a href="{{ route('berita.create') }}" class="btn btn-success mt-4">+New Data</a>
            <br>
            <br>
            <table class="table table bordered table striped" id="tabel-jabatan">
                <thead class="back">
                    <tr>
                        <th style="width:1%; color: white;">Id</th>
                        <th style="width:5%; color: white;">Judul</th>
                        <th style="width:3%; color: white;">Tanggal</th>
                        <th style="width:3%; color: white;">Gambar</th>
                        <th style="width:8%; color: white;">Isi</th>
                        <th style="width:2%; color: white;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($news))
                        @foreach ($news as $n)
                            <tr>
                                <td>{{ $n->id }}</td>
                                <td>{{ $n->judul }}</td>
                                <td>{{ $n->tgl }}</td>
                                <td>
                                    <img src="{{ asset('poster/' . $n->image) }}" alt="{{ $n['judul'] }}"
                                        class="a-pegawai">
                                </td>
                                <td id="news-content">{!! $n->isi !!}</td>
                                <td>
                                    <a href="{{ route('berita.edit', $n->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('berita.destroy', $n->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <p>No data available</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-layoutAdmin>
