<x-layout>
    <div class="profil-koperasi">
        <h2 class="text-center fw-bold judul-profil">Profil Koperasi</h2>
        <br>
        <div class="container">
            <section class="profil">
                <div class="profil-info">
                    <p class="tentang-profil3">Koperasi Konsumen Syariah Sukses Usaha Sejahtera (KOPSUS SYARIAH)
                        didirikan pada tahun 2004 di Kediri, Jawa Timur. Awalnya bernama "Koperasi Konsumen Syariah
                        Sukses Usaha Sejahtera" dan berstatus Koperasi Konsumen. Kemudian, berdasarkan Undang-Undang
                        Nomor 17 Tahun 2012 tentang Perkoperasian, KOPSUS SYARIAH ditetapkan menjadi "Koperasi Konsumen
                        Syariah Sukses Usaha Sejahtera" dan statusnya menjadi Koperasi Konsumen Syariah. <br><br>
                        KOPSUS SYARIAH resmi beroperasi pada tanggal 1 Januari 2024 setelah menunda kegiatan operasional
                        selama 3 tahun akibat pandemi Covid-19. KOPSUS SYARIAH menawarkan layanan penyimpanan dana dan
                        fasilitas pinjaman untuk segmen pembiayaan korporasi, menengah, dan kecil. Produk dan layanan
                        KOPSUS SYARIAH disesuaikan dengan kebutuhan anggota dan calon anggota, serta berpedoman pada
                        Prinsip Koperasi Syariah yang telah diatur dalam Fatwa Dewan Syariah Nasional dan Majelis Ulama
                        Indonesia No: 141/DSN-MUI/VIII/2021 tentang Pedoman Pendirian dan Operasional Koperasi Syariah.
                    </p>
                </div>
                <div class="profil-info">
                    <img src="{{ asset('gambar/zyro-image4.png') }}" alt="gambar10" class="gambar10">
                </div>
            </section>
        </div>
    </div>

    <div class="profil-koperasi">
        <h2 class="text-center fw-bold judul">Visi & Misi</h2>
        <br>
        <div class="container">
            <section class="profil">
                <div class="profil-info">
                    <img src="{{ asset('gambar/gambar2.png') }}" alt="gambar11" class="gambar11">
                </div>
                <div class="profil-info">
                    <div class="tentang-profil">
                        <h4 class="fw-bold warna-vm">Visi</h4>
                        <p class="tentang-profil3">Menjadi koperasi yang sehat dan sesuai dengan syariat Islam,
                            berkembang dan terpercaya, yang mampu melayani Anggota mencapai kehidupan yang penuh
                            keselamatan, kedamaian dan kesejahteraan.</p>
                        <h4 class="fw-bold mt-4 warna-vm">Misi</h4>
                        <ul class="tentang-profil3">
                            <li>Melambangkan Koperasi sebagai gerakan pembebasan ekonomi ribawi, gerakan pemberdayaan
                                Anggota, dan gerakan keadilan sehingga terwujud kualitas masyarakat di sekitar Koperasi
                                yang penuh keselamatan, kedamaian dan kesejahteraan mencipatakan kesejahteraan bagi para
                                Anggota yang berkesinambungan.</li>
                            <li>Berdaya guna sebagai mitra strategis dan terpercaya bagi Anggota.</li>
                            <li>Berkontribusi dalam perkembangan perkoperasian di Indonesia dan</li>
                            <li>Mengelola Koperasi dan unit usaha secara professional dengan menerapkan prinsip “Good
                                Corporate Governance”.</li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="back">
        <h2 class="text-center fw-bold" style="color: #ffffff; margin-top: 20px;">Struktur Organisasi</h2>
        <img src="{{ asset('gambar/struktur.png') }}" alt="Struktur" class="struktur">
    </div>

    <div class="pegawai">
        <h2 class="text-center fw-bold judul">Pegawai</h2>
        <br>
        <br>
        @if (!empty($karyawan))
            <div class="slide-container2 swiper">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">
                        @foreach ($karyawan as $k)
                            <div class="card swiper-slide" style="border: none">
                                <div class="card-content" style="border: none">
                                    <img src="{{ asset('foto/' . $k['image']) }}" alt="{{ $k['nama'] }}"
                                        class="g-pegawai">
                                    <br>
                                    <br>
                                    <h5 class="fw-bold">{{ $k['nama'] }}</h5>
                                    <p class="jabatan">{{ $k['jabatan']['nama_jabatan'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-next swiper-navBtn2"></div>
                <div class="swiper-button-prev swiper-navBtn2"></div>
                <div class="swiper-pagination"></div>
            </div>
        @else
            <p>No data available</p>
        @endif
    </div>
    <br>
    <br>
</x-layout>
