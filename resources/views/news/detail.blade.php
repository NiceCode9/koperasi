<x-layout>
    <div class="news-koperasi-detail">
        <div class="container">
            <section class="news-detail">
                <div class="news-item-detail">
                    <section class="profil">
                        <div class="profil-info">
                            <h4 class="fw-bold">{{ $news->judul }}</h4>
                            <h5 class="fw-bold">{{ $news->tgl }}</h5>
                            <p class="tentang-layanan2" id="news-content" style="margin-top: 20px">{!! $news->isi !!}</p>
                        </div>
                        <div class="profil-info">
                            @if($news->image)
                                <img src="{{ asset('poster/' . $news->image) }}" alt="gambar2" class="gambar4">
                            @endif
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </div>
</x-layout>