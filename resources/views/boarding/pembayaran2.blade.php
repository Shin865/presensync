<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Registrasi</title>
    <!-- CSS files -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/demo.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" layout-boxed">
    <script src="{{ asset('tabler/dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
                <img src="{{ asset('/tabler/static/logo2.png')}}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
          </h1>
      </header>
      
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Pembayaran
                </div>
                <h2 class="page-title">
                  Isi Nama Mitra Dan Email Yang Terdaftar
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="row">
              <div class="col-12">
                  @php
                    if(Session::get('success')){
                      echo '<div class="alert alert-success">'.Session::get('success').'</div>';
                    }elseif(Session::get('error')){
                      echo '<div class="alert alert-danger">'.Session::get('error').'</div>';
                    }
                    @endphp
                  </div>
                </div>
              <div class="row">
                <div class="col-12">
                  <form action="/pembayaranpaket2" id="formregis" method="POST" enctype="multipart/form-data">
                     @csrf 
                     <div class="row">
                      <div class="col-6">
                      <div class="card">
                          <div class="card-body">
                                  <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                     </svg>
                                    </span>
                                    <input type="text" id="nama_mitra" value="" class="form-control" name="nama_mitra" placeholder="Nama Mitra">
                                  </div>
                                    <div class="input-icon mb-3">
                                      <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                          <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                                          <path d="M3 7l9 6l9 -6"></path>
                                       </svg>
                                      </span>
                                      <input type="email" id="email" value="" class="form-control" name="email" placeholder="Email">
                                    </div>
                                    <div class="input-icon mb-3">
                                        <input type="file" name="bukti" class="form-control" id="bukti">
                                    </div>
                          <div class="form-group">
                            <button class="btn btn-primary w-100" type="submit">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 14l11 -11"></path>
                                <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                             </svg>
                             Simpan
                            </button>
                          </div>
                          </form>
                        </div>
                      </div>
                      </div>
              <div class="col-6">
                <div class="card" style="position: absolute; right:10%; top:15%">
                    <div class="card-body">
                      <div class="input-icon mb-2">
                        <p>Detail Pembayaran</p>
                        <input type="text" id="paket" value="PAKET 6 BULAN" class="form-control" name="paket" placeholder="PAKET 6 BULAN" readonly>
                         </div>

                         <div class="input-icon mb-1">
                        <input type="text" id="" value="Total Bayar" class="form-control" name="" placeholder="Total Bayar" readonly>
                        <input type="text" id="" value="RP. 225.000" class="form-control" name="harga" placeholder="RP. 225.000" readonly>
                         </div>
                         <p style="color: crimson">Bayar menggunakan link dibawah ini</p>
                      <img src="{{ asset('/tabler/static/saweria.png')}}" width="300" height="290" >
                      <br>
                      <center><a href="https://saweria.co/JukiKun" target="_blank" rel="noopener noreferrer">Saweria</a></center>
                    </div>
                </div>
            </div>

          </div>
      </div>
    <!-- Libs JS -->
    <script src="{{ asset('tabler/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('tabler/dist/libs/apexcharts/dist/apexcharts.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('tabler/dist/libs/jsvectormap/dist/maps/world.js?1692870487') }}" defer></script>
    <script src="{{ asset('tabler/dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487') }}" defer></script>
    <!-- Tabler Core -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('tabler/dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('tabler/dist/js/demo.min.js?1692870487') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>

    <script>
  
      $(document).ready(function() {
          $("#formregis").submit(function(e) {
              var nama_admin = $("#nama_admin").val();
              var email = $("#email").val();
              var password = $("#password").val();
              var paket = $("#paket").val();
              if(nama_admin == "" || email == "" || password == "" || paket== "") {
                  Swal.fire({
                      icon: 'error',
                      title: 'Gagal',
                      text: 'Semua field harus diisi',
                      showConfirmButton: false,
                      timer: 1500
                  });
                  return false;
              }
          });
      });
  </script>
  </body>
</html>