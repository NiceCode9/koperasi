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
            <div class="container">
                <div class="login-back">
                    <section class="login">
                        <div class="login-item">
                            <img src="{{ asset('gambar/zyro-image.png') }}" alt="login" class="g-login">
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="input-field">
                                    <label class="label-login fw-bold" for="username">Email atau No. Telepon</label>
                                    <input class="input-login" type="text" id="username" name="username"
                                        placeholder="Masukkan email atau no. telepon" required>
                                </div>
                                <div class="input-field">
                                    <label class="label-login fw-bold" for="password">Password</label>
                                    <input class="input-login" type="password" id="password" name="password"
                                        placeholder="Masukkan password" required>
                                </div>
                                <button class="btn-login" type="submit">Login</button>
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
