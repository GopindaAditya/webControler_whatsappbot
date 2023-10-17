<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">
    <title>DISDUKCAPIL KOTA DENPASAR</title>

</head>

<body class="bg-light">
    <nav class="navbar bg-light d-flex justify-content-between px-4 py-3 mb-5">
        @if (!Request::is('/') && !Request::is("logout"))
        <div class="d-flex align-items-center logo-container">
            <div class="dropdown container-fluid me-2">
                <button class="navbar-toggler" type="button" aria-label="Toggle navigation" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('dateList') }}">Menu Tanggal</a></li>
                    <li><a class="dropdown-item" href="{{ route('messagesList') }}">Tampil Pesan</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer;">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            <img src="{{ asset('images/logo-dps.png') }}" alt="Logo 1" class="logo-img mr-2">
        </div>
        @endif
        @if (Request::is('/') || Request::is('logout'))
        <div class="d-flex align-items-center logo-container ms-5">
            <img src="{{ asset('images/logo-dps.png') }}" alt="Logo 1" class="logo-img ms-5">
        </div>
        @endif
        <div class="d-flex align-items-center flex-grow-1 justify-content-center logo-text">
            <h2 class="d-flex align-items-center logo-container" id="text">ASISTEN VIRTUAL DISDUKCAPIL DENPASAR
                <br> DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL
                <br> KOTA DENPASAR
            </h2>
        </div>
        <div class="d-flex align-items-center logo-container me-5">
            <img src="{{ asset('images/logo-disdukcapil.png') }}" alt="Logo 2" class="logo-img me-5">
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.all.min.js"></script>
    <section class="bg-light">
        @yield('container')
    </section>

    <footer class="d-flex align-items-center justify-content-center footer">
        <div class="footer-content">
            <p>Copyright &copy; 2023</p>
            <p><b>Dinas Kependudukan dan Pencatatan Sipil Kota Denpasar</b></p>
            <p>Mal Pelayanan Publik Graha Sewaka Dharma (MPP-GSD) Telp. (0361) 428510, 428597.</p>
        </div>
    </footer>
</body>
@include('sweetalert::alert')

</html>