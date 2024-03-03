<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">

</head>

<body class="theme-dark" style="overflow-y: auto;">
    <div id="app">
        @include('partials.sidebar')
        <div id="main" class="layout-navbar">
            @include('partials.navbar')
            <div id="main-content">
                <div class="page-heading">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@yield('card_header')</h4>
                            </div>
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                    </section>
                </div>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2024 &copy; JOKERAN</p>
                        </div>
                        <div class="float-end">
                            <p>
                                Crafted with
                                <span class="text-danger">
                                    <i class="bi bi-heart-fill icon-mid">
                                    </i>
                                </span>by<a href="#"> Afandzo</a>
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    @yield('script')
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-element-select.js') }}"></script>
</body>

</html>
