<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>GastroCare</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('user/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('user/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('user/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('user/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top" style="box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      
      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Tambahkan gambar sebelum teks -->
        <img src="{{ asset('img/logoSP.png') }}" alt="Logo" style="width: 40px; height: 40px; margin-right: 10px;">
        <span class="brand-text font-weight-bold" style="font-size: 1.5rem; font-weight: bold; display: block;">
          <span style="color: #AE445A;">Gastro</span><span style="color: #740938;">Care</span>
        </span>
      </a>    

      <nav id="navmenu" class="navmenu">
        <ul>
          <li class="nav-item"><a class="nav-link {{ Request::is('landingpage*') ? 'active' : ''}}" href="{{ route('landingpage') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link {{ Request::is('info*') ? 'active' : ''}}" href="{{ route('info') }}">Info</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('login') }}">Login</a>

    </div>
  </header>

  <main class="main">
    <!-- Hero Section atau lainnya -->
    {{-- <section id="hero" class="hero section"> --}}
      @yield('content')
    {{-- </section> --}}
  </main>

  <footer id="footer" class="footer">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Appland</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('user/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('user/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('user/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('user/vendor/glightbox/js/glightbox.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('user/js/main.js') }}"></script>

</body>

</html>