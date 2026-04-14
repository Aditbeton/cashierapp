<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Login</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            {{-- <a href="/"><b>Madu</b>Jawa</a>  --}}
            @php
                $appName = config('app.name'); // "LapetShop"
                $lapet = substr($appName, 0, 5); // "Lapet"
                $shop = substr($appName, 5); // "Shop"
            @endphp
            <span style="filter: drop-shadow(0px 5px 6px rgba(0, 0, 0, 0.45));">
                <span class="brand-text text-danger"
                    style="font-family: Fredoka, sans-serif;
  font-optical-sizing: auto;
  font-size: 1.5rem;
  font-weight: 600;
  font-style: normal;
  text-shadow:
        -1px -1px 0 black,
         1px -1px 0 black,
        -1px  1px 0 black,
         1px  1px 0 black;">{{ $lapet }}</span>
                <span class="brand-text"
                    style="color:white; font-family: Fredoka, sans-serif;
  font-optical-sizing: auto;
  font-size: 1.5rem;
  font-weight: 600;
  font-style: normal;
  font-variation-settings: width: 100;
  text-shadow:
        -1px -1px 0 black,
         1px -1px 0 black,
        -1px  1px 0 black,
         1px  1px 0 black;  ">{{ $shop }}</span>
            </span>
        </div>
        <div class="card">
            <div class="card-body login-card-body card card-red card-outline">
                <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>
                <form action="/login" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="username"
                            class="form-control @error('username') is-invalid @enderror" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('username')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="row mt-3">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/adminlte/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>
