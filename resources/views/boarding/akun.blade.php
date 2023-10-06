<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Boarding Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/home/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/home/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/home/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/home/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/home/assets/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/home/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">


  <main id="main">

      <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <span><img src="{{ asset('tabler/static/logo.png') }}" alt="image" class="form-image"></span>
        <h1>PresenSync</h1>
      </a>

      <!-- Nav Menu -->
      <nav id="navmenu" class="navmenu" style="margin-right:10%">
        <ul>
          <li><a href="boarding" class="active">Beranda</a></li>
          <li><a href="boarding#about">Tentang Kami</a></li>
          <li><a href="boarding#harga">langganan</a></li>
          <li><a href="boarding#tim">Team</a></li>
          <li><a href="boarding#testimon">Testimoni</a></li>
          <li><a href="boarding#footer">Contact</a></li>
        </ul>

        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav><!-- End Nav Menu -->

    </div>
  </header><!-- End Header -->

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Konfigurasi
          </div>
          <h2 class="page-title">
            Konfigurasi Lokasi Kantor
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    @php
                    if(Session::get('success')){
                      echo '<div class="alert alert-success">'.Session::get('success').'</div>';
                    }elseif(Session::get('error')){
                       echo '<div class="alert alert-danger">'.Session::get('error').'</div>';
                     }
                    @endphp
                    <form action="/konfigurasi/updatelokkantor" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                              <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-cog" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v8"></path>
                                        <path d="M9 4v13"></path>
                                        <path d="M15 7v6.5"></path>
                                        <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M19.001 15.5v1.5"></path>
                                        <path d="M19.001 21v1.5"></path>
                                        <path d="M22.032 17.25l-1.299 .75"></path>
                                        <path d="M17.27 20l-1.3 .75"></path>
                                        <path d="M15.97 17.25l1.3 .75"></path>
                                        <path d="M20.733 20l1.3 .75"></path>
                                     </svg>
                                </span>
                                <input type="text" id="lokasi_kantor" value="" class="form-control" name="lokasi_kantor" placeholder="Lokasi Kantor">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-radar-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44"></path>
                                        <path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14"></path>
                                        <path d="M12 12v9"></path>
                                     </svg>
                                </span>
                                <input type="text" id="radius" value="" name="radius" class="form-control" placeholder="Radius">
                              </div>
                            </div>
                          </div>
                <div class="row mt-2">
                  <div class="col-12">
                    <div class="form-group">
                      <button class="btn btn-primary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M10 14l11 -11"></path>
                          <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                       </svg>
                       Simpan
                      </button>
                    </div>
                  </div>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
   
</main>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

  <div class="container footer-top">
    <div class="row">
      <div class="col-lg-12 col-md-12 footer-about">
        <a href="index.html" class="logo d-flex align-items-center">
          <span>Masih Bingung tentang presensync? atau ragu untuk bberlangganan? </span>
        </a>
        <p>Hubungi Kami pasti kami akan melayani dengan sepenuh hati.</p>
        <div class="d-flex mt-4">
          <a href=""><ion-icon name="mail"></ion-icon></a>
          <a href=""></a>
          <a href=""></a>
        </div>
      </div>

    </div>
  </div>

</footer><!-- End Footer -->

<!-- Scroll Top Button -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader">
  <div></div>
  <div></div>
  <div></div>
  <div></div>
</div>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/home/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/home/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/home/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/home/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/home/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/home/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/home/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/home/assets/js/main.js') }}"></script>

</body>

</html>