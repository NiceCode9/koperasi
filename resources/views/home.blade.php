<x-layout>
    <div class="container pengenal">
        <div class="row">
            <div class="col-md-8 d-flex align-items-center halaman-awal">
                <div>
                    <h1 class="fw-bold headline">Ajukan pembiayaan<br>yang relevan<br>di <span id="typed" class="typed"></span></h1>
                    <h5 class="fw-bold text-secondary">Kebutuhan terpenuhi, amalan tercukupi</h5>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center halaman-awal">
                <img src="{{ asset('gambar/zyro-image.png') }}" alt="gambar1" class="gambar1 img-fluid">
            </div>
        </div>
    </div>

    <div class="profil-koperasi">
        <h2 class="text-center fw-bold judul-profil">Tentang Kami</h2>
        <br>
        <div class="container">
            <section class="tentang">
                <div class="profil-info">
                    <img src="{{ asset('gambar/zyro-image4.png') }}" alt="gambar2" class="gambar2">
                </div>
                <div class="col-md-6 tentang">
                    <div>
                        <p class="text">Kopsus Syariah sebuah lembaga keuangan mikro yang berkomitmen pada prinsip-prinsip syariah dalam menyediakan layanan simpan pinjam. Dibentuk untuk memperkuat ekonomi masyarakat dengan pendekatan yang adil, inklusif, dan berkelanjutan. </p>
                        <br>
                        <br>
                        <a href="/profil" class="tombol">Baca Selengkapnya</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <div class="back">
        <h2 class="text-center fw-bold" style="color: #ffffff;">Layanan</h2>
        <br>
        <h4 class="text-center fw-bold" style="color: #ffffff;">Berikut layanan yang ada di Kopsus Syariah</h4>
        <br>
        <br>
        <br>
        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    <div class="card swiper-slide">
                        <div class="card-content">
                            <h3 class="fw-bold">Pembiayaan <br> Murabahah</h3>
                            <br>
                            <p class="amanah">Akad pembiayaan untuk pembelian barang dengan harga jual sebesar harga perolehan ditambah keuntungan yang disepakati dan penjual harus mengungkapkan harga perolehan kepada pembeli.</p>
                            <a href="/pembiayaan-murabahah" class="tombol">Selengkapnya</a>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="card-content">
                            <h3 class="fw-bold">Simpanan <br> Amanah</h3>
                            <br>
                            <p class="amanah">Simpanan bersifat umum yang penyimpanan dan penarikannya dapat dilakukan kapan saja oleh Anggota pada hari kerja operasional kantor KOPSUS SYARIAH.</p>
                            <a href="/simpanan-amanah" class="tombol">Selengkapnya</a>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="card-content">
                            <h3 class="fw-bold">Simpanan <br> Umroh & Haji</h3>
                            <br>
                            <p class="amanah">Jenis produk simpanan yang disediakan untuk persiapan melakukan ibadah umroh atau haji sebagai tambahan uang saku atau pelunasan pembayaran ongkos umroh atau haji.</p>
                            <a href="/simpanan-umroh-dan-haji" class="tombol">Selengkapnya</a>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="card-content">
                            <h3 class="fw-bold">Simpanan <br> Wadiah</h3>
                            <br>
                            <p class="amanah">Jenis simpanan atau penitipan dana dimana pihak Koperasi dengan atau tanpa izin pemilik dana dapat memanfaatkan dana titipan dan harus bertanggung jawab terhadap dana tersebut. </p>
                            <a href="/simpanan-wadiah" class="tombol">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="kontak-kami">
        <h2 class="text-center fw-bold judul">Kontak Kami</h2>
        <br>
        <div class="container">
            <section class="kontak">
                <div class="kontak-info">
                    <h2 class="fw-bold kontak-hp">Mau tanya dulu? <br> Hubungi kami disini</h2>
                    <br>
                    <a href="https://wa.me/6281281424422" class="btn-kontak">Whatsapp</a>
                </div>
                <div class="kontak-info">
                    <h2 class="fw-bold kontak-hp">Lokasi Kami</h2>
                    <br>
                    <h4 class="fw-bold alamat">Kantor Pusat Grogol</h4>
                    <h5 class="fw-bold alamat" style="color: #363636">Jl Raya Gringging Ruko Sarwoaji <br> Blok 1 & 2 Desa Cerme, Kec. Grogol, <br>Kab. Kediri - 64151</h5>
                    <br>
                    <h4 class="fw-bold alamat">Kantor Kas Tiron</h4>
                    <h5 class="fw-bold alamat" style="color: #363636">Jl Raya Bulawen Ruko Orange <br> Blok 3 Desa Tiron, Kec. Banyakan, <br> Kab. Kediri - 64157</h5>
                </div>
            </section>
            <br>
            <br>
            <h4 class="text-center fw-bold">Temukan kami di sosial media</h4>
            <br>
            <section class="kontak">
                <div>
                    <a href="https://www.instagram.com/kopsus.syariah/" class="logo"><img src="{{ asset('gambar/instagram.png') }}" alt="Instagram" class="logo"></a>
                </div>
                <div>
                    <a href="https://web.facebook.com/KoperasiKOPSUS" class="logo"><img src="{{ asset('gambar/facebook.png') }}" alt="Facebook" class="logo"></a>
                </div>
            </section>
        </div>
    </div>
</x-layout>