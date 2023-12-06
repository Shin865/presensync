@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Overview
          </div>
          <h2 class="page-title">
            Rekap Presensi Hari Ini 
          <!--{{ date('d-m-Y',strtotime(date('Y-m-d'))) }}-->
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <a href="/presensi/monitoring">
                        <span class="bg-success text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->   
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-fingerprint" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3"></path>
                                <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6"></path>
                                <path d="M12 11v2a14 14 0 0 0 2.5 8"></path>
                                <path d="M8 15a18 18 0 0 0 1.8 6"></path>
                                <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95"></path>
                             </svg>  
                        </span>
                      </a>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          {{ $rekappresensi['jmlhadir'] }}
                        </div>
                        <div class="text-secondary">
                          Karyawan Hadir
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <a href="/presensi/izinsakit">
                        <span class="bg-info text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->  
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <path d="M9 9l1 0"></path>
                                <path d="M9 13l6 0"></path>
                                <path d="M9 17l6 0"></path>
                             </svg>
                        </span>
                      </a>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                        {{ $rekapizin['jmlizin'] != null ? $rekapizin['jmlizin'] : 0 }}
                        </div>
                        <div class="text-secondary">
                          karyawan Izin
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <a href="/presensi/izinsakit">
                        <span class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-medical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                <path d="M10 14l4 0"></path>
                                <path d="M12 12l0 4"></path>
                             </svg>
                        </span>
                      </a>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                        {{ $rekapizin['jmlsakit'] != null ? $rekapizin['jmlsakit'] : 0 }}
                        </div>
                        <div class="text-secondary">
                          karyawan Sakit
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <a href="/presensi/monitoring">
                        <span class="bg-warning text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-month" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                            <path d="M16 3v4" />
                            <path d="M8 3v4" />
                            <path d="M4 11h16" />
                            <path d="M7 14h.013" />
                            <path d="M10.01 14h.005" /><path d="M13.01 14h.005" />
                            <path d="M16.015 14h.005" /><path d="M13.015 17h.005" />
                            <path d="M7.01 17h.005" />
                            <path d="M10.01 17h.005" />
                          </svg>
                        </span>
                        </a>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          {{ $rekapizin['jmlcuti'] != null ? $rekapizin['jmlcuti'] : 0 }}
                        </div>
                        <div class="text-secondary">
                          karyawan Cuti
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
  </div>
@endsection