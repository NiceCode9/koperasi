<x-layout>
    <div class="profil-koperasi">
        <h2 class="text-center fw-bold judul-profil">Profil Koperasi</h2>
        <br>
        <div class="container">
            <section class="profil">
                <div class="profil-info">
                    <p class="tentang-profil3">Koperasi Simpan Pinjam Pembiayaan Syariah BMT NU Jombang Didirikan pada
                        tanggal 31 Maret 2013 oleh Lembaga Perekonomian Nahdlatul Ulama (LPNU) Jombang. Tujuannya adalah
                        untuk meningkatkan perekonomian dan kesejahteraan warga Nahdlatul Ulama (NU) Jombang, serta
                        mendorong upaya membangun ekonomi masyarakat sekitar dengan berlandaskan syariat Islam serta
                        dikelola secara profesional dengan mengedepankan prinsip kehati-hatian dan tata kelola keuangan
                        yang berbasic sistem keuangan semi perbankan. <br><br>
                        BMT NU Jombang telah berkembang pesat sejak didirikan. Pada tahun ini 2025, BMT NU Jombang telah
                        memiliki 21 kantor cabang yang tersebar di berbagai wilayah di Jombang. BMT NU Jombang juga
                        telah memiliki berbagai produk dan layanan keuangan syariah, seperti simpanan, pembiayaan, dan
                        jasa lainnya.
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
                        <p class="tentang-profil3">Menjadi lembaga keuangan yang mandiri, sehat, kuat, yang kualitas
                            ibadah anggotanya meningkat sedemikian rupa, sehingga mampu berperan menjadi wakil pribadi
                            Allah memakmurkan kehidupan anggota pada khususnya dan ummat manusia pada umumnya.</p>
                        <h4 class="fw-bold mt-4 warna-vm">Misi</h4>
                        <ul class="tentang-profil3">
                            <li>Mengembangkan BMT yang maju berkembang, terpercaya, aman, nyaman.</li>
                            <li>Transparan dan berkehati-hatian sehingga dapat mewujudkan Gerakan Pembebasan anggota dan
                                masyarakat dari ikatan rentenir, jerat kemiskinan dan ekonomi ribawi.</li>
                            <li>Gerakan Pemberdayaan meningkatkan kapasitas dalam kegiatan ekonomi riil dan
                                kelembagaanya menuju tatanan perekonomian yang makmur dan maju.</li>
                            <li>Gerakan Keadilan membangun struktur masyarakat madani yang adil berkemakmuran dan
                                berkemajuan, serta makmur maju berkeadilan berlandaskan syariah dan ridla Allah SWT.
                            </li>
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
