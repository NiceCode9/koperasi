<header class="header" id="header">
    <nav>
        <div class="logo">
            <img src="{{ asset('gambar/logo2 no-bg.png') }}" alt="logo" />
            <h1>Kopsus Syariah</h1>
        </div>
        <ul>
            <li>
                <a href="/">Beranda</a>
            </li>
            <li>
                <a href="/profil">Profil</a>
            </li>
            <li>
                <a href="/news">News</a>
            </li>
            <li>
                <a href="{{ route('simulasi') }}">Simulasi</a>
            </li>
            <li>
                <a id="btn-login" href="/login">Login</a>
            </li>
        </ul>
        <div class="hamburger">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </nav>
    <div class="menubar">
        <ul>
            <li>
                <a href="/">Beranda</a>
            </li>
            <li>
                <a href="/profil">Profil</a>
            </li>
            <li>
                <a href="/news">News</a>
            </li>
            <li>
                <a href="{{ route('simulasi') }}">Simulasi</a>
            </li>
            <li>
                <a id="btn-login" href="/login">Login</a>
            </li>
        </ul>
    </div>
</header>
