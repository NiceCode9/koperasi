<x-layout>
    <div class="news-koperasi">
        <div class="container">
            <h2 class="text-center fw-bold judul-profil">News</h2>
            <br>
            <section class="news">
                @if(!empty($news))
                    @foreach ($news as $n)
                        <div class="news-item">
                            <h4 class="fw-bold">{{ $n->judul }}</h4>
                            <h6 class="fw-bold">{{ $n->tgl }}</h6>
                            <p class="tentang-news" id="news-content" style="margin-top: 20px">{{ Str::limit($n['isi'], 220) }}</p>
                            <br>
                            <a href="{{ route('news.show', $n->id) }}" class="tombol">Baca Selengkapnya</a>
                        </div>
                    @endforeach
                @else
                    <p>No data available</p>
                @endif
                
                <div class="d-flex justify-content-center pagi">
                    {{ $news->links() }}
                </div>
            </section>
        </div>
    </div>
</x-layout>