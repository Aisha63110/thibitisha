
<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login - {{ env('APP_NAME') }} </title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="{{ env('APP_NAME') }} Login" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('adminlte/css/adminlte.css') }}" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <style>
        /* Thibitisha Login Button */
        .btn-thibitisha {
            background: linear-gradient(135deg, #227d95, #1aa3b0);
            border: none;
            color: #fff;
            font-weight: 500;
            letter-spacing: 0.5px;
            padding: 0.65rem 1.25rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 10px rgba(34, 125, 149, 0.4);
        }

        .btn-thibitisha:hover {
            background: linear-gradient(135deg, #1aa3b0, #227d95);
            box-shadow: 0 6px 14px rgba(34, 125, 149, 0.6);
            transform: translateY(-2px);
        }

        .btn-thibitisha:active {
            transform: translateY(1px);
            box-shadow: 0 3px 6px rgba(34, 125, 149, 0.4);
        }

        .btn-thibitisha:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(34, 125, 149, 0.3);
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="login-page bg-body-secondary">
      {{-- show login errors, make the div appear at the top --}}
    @if ($errors->any())
        <div class="alert alert-danger m-3">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
        </div>
    @endif
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ URL::to('/') }}">
                <img src="{{ asset('logo-login.png') }}" alt="{{ env('APP_NAME') }} Logo" width="60%" />
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in</p>
                <form action="{{ route('login.submit') }}" method="POST">
    @csrf
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" />
        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
    </div>
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
    </div>
    @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="row">
        <div class="col-6">
            <div class="form-check">
                <input class="form-check-input" name="remember" type="checkbox" id="flexCheckDefault" />
                <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
            </div>
        </div>
        <div class="col-6">
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-thibitisha mb-2">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>
            </div>
        </div>
    </div>
</form>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../js/adminlte.js"></script>
    <!--end::Script-->
</body>
<!--end::Body-->

</html>

