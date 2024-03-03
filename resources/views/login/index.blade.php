<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
</head>

<body>
    <div id="auth">
        
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <img src="assets/images/logo/FRNT2.png" alt="Logo" style="width: 110%; height: 110%;">
            </div>
            <h1 class="auth-title">Log in.</h1>
            <form action="/login" method="post">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    {{-- ALERT --}}
                    @if ($message = Session::get('success'))
                    <div class="alert alert-light-success color-success alert-dismissible show fade">
                        <i class="bi bi-check-circle"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if ($message = Session::get('loginError'))
                    <div class="alert alert-light-danger color-danger alert-dismissible show fade">
                        <i class="bi bi-check-circle"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Username" name="username" autofocus required>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Log in</button>
            </form>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">
            <img src="assets/images/logo/front2.jpg" alt="Logo" style="max-width: 100%; max-height: 100%;">
        </div>
    </div>
</div>

    </div>
</body>

<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
</html>
