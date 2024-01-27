<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        <style>
        /* Letakkan style CSS di sini */

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80vh;
            background-color: #f8f9fa;
            /* Warna latar belakang */
        }

        .login-form {
            max-width: 400px;
            width: 100%;
            padding: 10px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .login-form:hover {
            transform: scale(1.05);
            /* Zoom-in saat hover */
        }

        .form-label {
            font-weight: bold;
            color: #495057;
            /* Warna label */
        }

        .form-control {
            border: 1px solid #ced4da;
            /* Warna border input */
            border-radius: 5px;
        }

        .invalid-feedback {
            color: #dc3545;
            /* Warna teks feedback */
        }

        .btn-primary {
            background-color: #007bff;
            /* Warna latar tombol */
            border: 1px solid #007bff;
            /* Warna border tombol */
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Warna latar tombol saat hover */
            border: 1px solid #0056b3;
            /* Warna border tombol saat hover */
        }
    </style>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/daterangepicker/datepicker.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/daterangepicker/datepicker.min.css') }}">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/daterangepicker/datepicker.min.css') }}">

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/id.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/daterangepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/highchart/highcharts.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/daterangepicker/datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/daterangepicker/bootstrap-datepicker.js') }}"></script>
    <link href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            {{-- <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">E-LETTER ADMIN</span>
                                </a>
                            </div><!-- End Logo --> --}}

                            <div class="card mb-3 login-form">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title pb-0 fs-4">Welcome</h5>
                                        <p class="small">Please login to your account</p>
                                        <hr>
                                    </div>

                                    <form action="{{ route('login_post') }}" class="row g-3 needs-validation"
                                        method="POST">
                                        @csrf

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"></span>
                                                <input type="text" name="username"
                                                    class="form-control form-control-sm" id="yourUsername" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-2">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <div class="input-group has-validation mb-3">
                                                <span class="input-group-text" id="inputGroupPrepend"></span>
                                                <input type="password" name="password"
                                                    class="form-control form-control-sm" id="yourPassword" required>
                                                <div class="invalid-feedback">Please enter your password!</div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary w-100" type="submit">Login</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

</body>

</html>
