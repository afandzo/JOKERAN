<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main/app.css" />
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.svg" type="image/x-icon" />
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png" />
    <link rel="stylesheet" href="../assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="../assets/css/pages/simple-datatables.css">
    <link rel="stylesheet" href="../assets/extensions/choices.js/public/assets/styles/choices.css">
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
</head>

<body class="theme-dark" style="overflow-y: auto;">
    <div id="app">
        @include('partials.sidebar')
        <div id="main" class="layout-navbar">
            @include('partials.navbar')
            <div id="main-content">
                <div class="page-heading">
                    <section class="section">
                      <div class="page-heading">
                        <h3>Profile Statistics</h3>
                      </div>

                    </section>
                </div>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2023 &copy; JOKER</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    {{-- @yield('script') --}}
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="../assets/js/pages/simple-datatables.js"></script>
    <script src="../assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="../assets/js/pages/form-element-select.js"></script>
    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
</body>

</html>