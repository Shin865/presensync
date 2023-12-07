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
          <li><a href="#" class="active">Beranda</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#harga">langganan</a></li>
          <li><a href="#tim">Team</a></li>
          <li><a href="#testimon">Testimoni</a></li>
       <!--   <li><a href="#footer">Contact</a></li> -->
        </ul>

        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav><!-- End Nav Menu -->

    </div>
  </header><!-- End Header -->
  <!-- Hero Section - Home Page -->
<section id="hero" class="hero">

    <img src="{{ asset('assets/home/assets/img/hero-bg.png') }}" alt="" data-aos="fade-in">
    
    <div class="container">
      <div class="row">
        <div class="col-lg-10">
          <h2 data-aos="fade-up" data-aos-delay="100">Upgrade Sistem Presensi Sekolah Anda</h2>
          <p data-aos="fade-up" data-aos-delay="200">Sistem Presensi Masih Manual? Kini hadir PresenSync untuk membantu efisiensi sistem presensi sekolah anda</p>
          <br>
          <a href="#harga" class="btn btn-danger" style="padding: 10px;font-size:15px">
            Langganan dan nikmati sekarang</a>
        </div>
        </div>
    </div>
    
    </section><!-- End Hero Section -->
    
<!-- Features Section - Home Page -->
<section id="features" class="features">

<div class="container">

<!-- Features Item -->

<div class="row gy-6 align-items-stretch justify-content-between features-item ">
<div class="col-lg-5 d-flex align-items-center features-img-bg" data-aos="zoom-out">
<img src="{{ asset('assets/home/assets/img/aplikasi.jpg') }}" class="img-fluid" alt="">
</div>
<div class="col-lg-5 d-flex justify-content-center flex-column" data-aos="fade-up">
<h3>Presensi secara Online</h3>
<p align="justify">Presensi manual pastinya membutuhkan banyak kertas dan juga membutuhkan proses yang lama dalam perekapan presensi tersebut,
     dengan Presensync, Anda bisa melakukan presensi secara lebih efisien dan cepat dalam proses hal perekapan data.
     anda hanya perlu membuka website dan melakukan presensi maka data presensi akan langsung masuk ke database,
     selain itu admin dapat mengecek hasil presensi dan mengatur lokasi serta jarak radius presensi dapat dilakukan.</p>
</div>
</div><!-- Features Item -->

</div>

</section>
<!-- End Features Section -->
    <!-- About Section - Home Page -->
    <section id="about" class="about">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row align-items-xl-center gy-5">
  
            <div class="col-xl-5 content">
              <h3>Tentang Kami</h3>
              <h2>Presensi secara Online</h2>
              <p align="justify">Sistem Informasi Presensi Online Berbasis Website (PresenSync) merupakan sebuah website untuk presensi pegawai yang terhubung dengan internet secara online dan lebih efisien karena dapat dilakukan di mana saja dengan menampilkan bukti sebuah foto wajah dan lokasi ketika melakukan presensi.</p>
  
            </div>
  
            <div class="col-xl-7">
              <div class="row gy-4 icon-boxes">
  
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                  <div class="icon-box">
                    <i class="bi bi-buildings"></i>
                    <h3>Penggunaan Sederhana</h3>
                    <p>Sistem yang mudah dipahami dan digunakan.</p>
                  </div>
                </div> <!-- End Icon Box -->
  
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                  <div class="icon-box">
                    <i class="bi bi-clipboard-pulse"></i>
                    <h3>Langganan dengan harga murah</h3>
                    <p>Pastikan anda menikmati sistem ini, karena harganya sangat terjangkau.</p>
                  </div>
                </div> <!-- End Icon Box -->
  
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                  <div class="icon-box">
                    <i class="bi bi-command"></i>
                    <h3>Kecepatan</h3>
                    <p>Terjamin kecepatanan sistemnya</p>
                  </div>
                </div> <!-- End Icon Box -->
  
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                  <div class="icon-box">
                    <i class="bi bi-graph-up-arrow"></i>
                    <h3>Efisiesi waktu</h3>
                    <p>Dengan sistem ini waktu anda akan lebih fleksibel</p>
                  </div>
                </div> <!-- End Icon Box -->
  
              </div>
            </div>
  
          </div>
        </div>
  
      </section><!-- End About Section -->
       <!-- Pricing Section - Home Page -->
 <section id="harga" class="pricing">

  <!--  Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Langganan</h2>
    <p>Nikmati fiturnya tanpa batas dengan berlangganan di PresenSync</p>
  </div><!-- End Section Title -->
  
  <div class="container" data-aos="zoom-in" data-aos-delay="100">
  
    <div class="row">
  
      <div class="col-5" style="margin-left: 5%">
        <div class="pricing-item featured">
          <h3>Paket 3 Bulan</h3>
          <div class="icon">
            <i class="bi bi-box"></i>
          </div>
          <h4><sup>Rp</sup>125.000<span></h4>
          <ul>
            <li><i class="bi bi-check"></i> <span>Fitur Presensi</span></li>
            <li><i class="bi bi-check"></i> <span>Fitur Perekapan Presensi</span></li>
            <li><i class="bi bi-check"></i> <span>Riwayat Presensi</span></li>
            <li><i class="bi bi-check"></i> <span>Cetak Laporan</span></li>
            <li><i class="bi bi-check"></i> <span>Data Lokasi</span></li>
            <li><i class="bi bi-check"></i> <span>3 Bulan</span></li>
          </ul>
          <div class="text-center"><a href="/boarding/akun" class="buy-btn">Pesan Sekarang</a></div>
        </div>
      </div><!-- End Pricing Item -->
  
      <div class="col-5" style="margin-left: 5%">
        <div class="pricing-item featured">
          <h3>Paket 6 Bulan</h3>
          <div class="icon">
            <i class="bi bi-rocket"></i>
          </div>
  
          <h4><sup>Rp</sup>225.000<span></h4>
          <ul>
            <li><i class="bi bi-check"></i> <span>Fitur Presensi</span></li>
            <li><i class="bi bi-check"></i> <span>Fitur Perekapan Presensi</span></li>
            <li><i class="bi bi-check"></i> <span>Riwayat Presensi</span></li>
            <li><i class="bi bi-check"></i> <span>Cetak Laporan</span></li>
            <li><i class="bi bi-check"></i> <span>Data Lokasi</span></li>
            <li><i class="bi bi-check"></i> <span>6 Bulan</span></li>
          </ul>
          <div class="text-center"><a href="/boarding/akun" class="buy-btn">Pesan Sekarang</a></div>
        </div>
      </div><!-- End Pricing Item -->
  
    </div>
  
  </div>
  
  </section><!-- End Pricing Section -->
   <!-- Faq Section - Home Page -->
 <section id="faq" class="faq">

  <div class="container">
  
    <div class="row gy-4">
  
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="content px-xl-5">
          <h3><span>Pertanyaan yang sering ditanyakan</span></h3>
          <p>
            Masih bingung tentang PresenSync ? Berikut adalah pertanyaan yang sering ditanyakan.
          </p>
        </div>
      </div>
  
      <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
  
        <div class="faq-container">
          <div class="faq-item faq-active">
            <h3><span class="num">1.</span> <span>Mengapa PresenSync penting? </span></h3>
            <div class="faq-content">
              <p>Kalau anda masih melakukan presensi secara manual pastinya anda tahu bahwa perekapan data serta waktu 
                pegawai presensi itu tidak fleksibel, ituleh terkadang anda perlu mengubah sistem yang lama menjadi sistem yang lebih baik lagi 
                dengan menggunakan PresenSync</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div><!-- End Faq item-->
  
          <div class="faq-item">
            <h3><span class="num">2.</span> <span>Bagaimana cara menggunakan tool PresenSync ini? </span></h3>
            <div class="faq-content">
              <p>anda hanya perlu membuka website dan melakukan presensi maka data presensi akan langsung masuk ke database, 
                selain itu admin dapat mengecek hasil presensi dan mengatur lokasi serta jarak radius presensi dapat dilakukan.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div><!-- End Faq item-->
  
          <div class="faq-item">
            <h3><span class="num">3.</span>Bagaimana Cara Berlangganan di website PresenSync?</span></h3>
            <div class="faq-content">
              <p>Anda hanya perlu memilih paket langganan yang akan dipilih, setelah itu anda akan diminta untuk mengisi sebuah form untuk berlanggana,
                jika sudah pesanan anda akan diproses, dan akun anda akan dikonfirmasi setelah itu siap digunakan</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div><!-- End Faq item-->
        </div>
  
      </div>
    </div>
  
  </div>
  
  </section><!-- End Faq Section -->
  <style>
    .posisi {
      margin-right: 10% ;
    }
  </style>
  <!-- Team Section - Home Page -->
  <section id="tim" class="team">
  
  <!--  Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Team</h2>
    <p>Website PresenSync Ini Dibuat Oleh Beberapa Team </p>
  </div><!-- End Section Title -->
  
  <div class="container">
  
    <div class="row gy-4">
  
      <div class="col-4 member" data-aos="fade-up" data-aos-delay="200">
        <div class="member-img">
          <img src="{{ asset('assets/home/assets/img/1.jpg') }}" class="img-fluid" alt="">
        </div>
        <div class="member-info text-center">
          <h4>Anggi Thoat Ariyanto</h4>
        </div>
      </div><!-- End Team Member -->
  
      <div class="col-4 member" data-aos="fade-up" data-aos-delay="200">
        <div class="member-img">
          <img src="{{ asset('assets/home/assets/img/2.jpg') }}" class="img-fluid " alt="">
        </div>
        <div class="member-info text-center">
          <h4>Hanny Olivia</h4>
        </div>
      </div><!-- End Team Member -->
  
      <div class="col-4 member" data-aos="fade-up" data-aos-delay="200">
        <div class="member-img">
          <img src="{{ asset('assets/home/assets/img/3.jpg') }}" class="img-fluid" alt="">
        </div>
        <div class="member-info text-center">
          <h4>M Safri Syamsudin</h4>
        </div>
      </div><!-- End Team Member -->
  
    </div>
  </div>
  </section><!-- End Team Section -->
  

<section id="testimon" class="testimonials" >

  <div class="container">
  
    <div class="row align-items-center">
  
      <div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
        <h3>Testimoni</h3>
        <p>
          Testimoni di samping mencerminkan pengalaman nyata dari pengguna yang telah 
          menggunakan website PresenSync dan puas dengan hasilnya. Testimoni ini menunjukkan
           kegunaan website tersebut dalam meningkatkan efisiensi dan memberikan kesan positif kepada para pengguna.
        </p>
      </div>
  
      <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
  
        <div class="swiper">
          <template class="swiper-config">
            {
            "loop": true,
            "speed" : 600,
            "autoplay": {
            "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
            }
            }
          </template>
          <div class="swiper-wrapper">
  
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="d-flex">
                  <img src="assets/img/sample/avatar/avatar1.jpg" class="testimonial-img flex-shrink-0" alt="">
                  <div>
                    <h3>Anggi</h3>
                    <h4>Kepala Sekolah</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Websitenya Praktis dan mudah digunakan, dijamain meningkatkan efisensi pekerjaan, nyesel kalau tidak  mencoba</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->
  
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="d-flex">
                  <img src="assets/img/sample/avatar/avatar2.png" class="testimonial-img flex-shrink-0" alt="">
                  <div>
                    <h3>Nanat</h3>
                    <h4>Guru</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Aplikasi ini sangat mudah digunakan, cepat, dan akurat. sehingga saya tidak perlu repot-repot mengurus urusan melakukan pencatatan kehadiran pegawai secara manual lagi</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->
  
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="d-flex">
                  <img src="assets/img/sample/avatar/avatar2.png" class="testimonial-img flex-shrink-0" alt="">
                  <div>
                    <h3>Panniw</h3>
                    <h4>Instansi Pendidikan</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Saya sangat merekomendasikan website ini kepada siapa pun 
                    yang ingin meningkatkan kualitas pencatatan kehadiran pegawai mereka dengan cepat dan mudah.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->
  
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="d-flex">
                  <img src="assets/img/sample/avatar/avatar1.jpg" class="testimonial-img flex-shrink-0" alt="">
                  <div>
                    <h3>Juki</h3>
                    <h4>instansi Pendidikan</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Aplikasi ini sangat membantu saya dalam meningkatkan produktivitas dan efisiensi kerja saya.
                  </span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->
  
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="d-flex">
                  <img src="assets/img/sample/avatar/avatar2.png" class="testimonial-img flex-shrink-0" alt="">
                  <div>
                    <h3>Depoy</h3>
                    <h4>Guru</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Saya merekomendasikan aplikasi ini kepada semua orang yang ingin memudahkan proses presensi di tempat kerja. Terima kasih, aplikasi presensi!. </span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->
  
          </div>
          <div class="swiper-pagination"></div>
        </div>
  
      </div>
  
    </div>
  
  </div>
  
  </section><!-- End Testimonials Section -->
   
  </main>

  <!-- ======= Footer ======= 
  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row">
        <div class="col-lg-12 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span>Masih Bingung tentang presensync? atau ragu untuk berlangganan? </span>
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

  </footer><!-- End Footer -->-->

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