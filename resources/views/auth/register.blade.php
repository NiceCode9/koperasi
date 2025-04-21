<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kopsus Syariah</title>
    <link rel="icon" href="{{ asset('gambar/logo2 no-bg.png') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
</head>

<body>
    <main>
        <div class="login-koperasi">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container">
                <div class="login-back">
                    <section class="login">
                        <div class="login-item">
                            <img src="{{ asset('gambar/zyro-image.png') }}" alt="login" class="g-login">
                            <form action="{{ route('register.store') }}" method="POST">
                                @csrf
                                <div class="input-field">
                                    <label class="label-login fw-bold" for="name">Nama Lengkap</label>
                                    <input class="input-login" type="text" id="name" name="name"
                                        placeholder="Masukkan Nama Lengkap" required>
                                </div>
                                <div class="input-field">
                                    <label class="label-login fw-bold" for="email">Email atau No. Telepon</label>
                                    <input class="input-login" type="email" id="email" name="email"
                                        placeholder="Masukkan email" required>
                                </div>
                                <div class="input-field">
                                    <label class="label-login fw-bold" for="telephone">Telephone</label>
                                    <input class="input-login" type="number" id="telephone" name="telephone"
                                        placeholder="Masukkan Nomor Telephone" required>
                                </div>
                                <div class="input-field">
                                    <label class="label-login fw-bold" for="password">Password</label>
                                    <input class="input-login" type="password" id="password" name="password"
                                        placeholder="Masukkan password" required>
                                </div>
                                <button class="btn-login" type="submit">Register</button>
                                <div class="text-center mt-3">
                                    <a href="{{ route('login') }}" class="text-decoration-none">Sudah punya akun?
                                        Login
                                        sekarang</a>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @include('sweetalert::alert')
</body>

</html>
