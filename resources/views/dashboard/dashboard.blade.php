@extends('layouts.presensi')
@section('content')
<!-- App Capsule -->
<div id="appCapsule">
    <div class="section" id="user-section">
        <div class="row">
        <div class="col-12">
        <div id="user-detail">
            <a href="/editprofile">
            <div class="avatar">
                @if(!empty(Auth::guard('karyawan')->user()->foto))
                @php
                    $path = Storage::url('uploads/karyawan/'.Auth::guard('karyawan')->user()->foto)
                @endphp
                <img src="{{ url($path) }}" alt="avatar" class="imaged w64" style="height: 70px">
                @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                @endif
            </div>
            </a>
            <div id="user-info">
                <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h2>
                <span id="user-role">{{ Auth::guard('karyawan')->user()->pangkat }}</span>
            </div>
            <div>
                <a href="/proseslogout" class="btn btn-danger btn-sm" style="position: absolute; right:1%; top:1%; font-size:0,8rem; z-index:999">
                    <ion-icon name="log-out-outline"></ion-icon>
                    Logout</a>
            </div>
        </div>
    </div>

</div>
</div>
    
    <div class="section" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if($presensihariini != null)
                                    @php
                                        $path = Storage::url('/uploads/absensi/'.$presensihariini->foto_in);    
                                    @endphp
                                    <img src="{{ url($path) }}" alt="image" class="imaged w48">
                                    @else
                                    <a href="/presensi/create" style="color: white">
                                    <ion-icon name="camera"></ion-icon>
                                    </a>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $presensihariini != null ? $presensihariini->jam_in : 'Belum Presensi'}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if($presensihariini != null && $presensihariini->jam_out != null)
                                    @php
                                        $path = Storage::url('/uploads/absensi/'.$presensihariini->foto_out);    
                                    @endphp
                                    <img src="{{ url($path) }}" alt="image" class="imaged w48">
                                    @else
                                    <a href="/presensi/create" style="color: white">
                                    <ion-icon name="camera"></ion-icon>
                                    </a>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>{{ $presensihariini != null && $presensihariini->jam_out != null ? $presensihariini->jam_out : 'Belum Presensi'}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="rekap">
            <h4 class="title">Rekap Bulan {{ $bln[$bulanini] }}</h4>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <a href="/presensi/histori" style="color: black">
                        <div class="card-body text-center" style="padding: 16px 12px !important line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:0%; right:1%; font-size:0.5rem; z-index:999">{{ $rekappresensi->jmlhadir }}</span>
                            <ion-icon name="accessibility" style="font-size: 1.7rem" class="text-primary mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                        </div>
                    </a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <a href="/presensi/izin" style="color: black">
                        <div class="card-body text-center" style="padding: 16px 12px !important line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:0%; right:1%; font-size:0.5rem; z-index:999">{{ $rekappresensi->jmlizin }}</span> 
                            <ion-icon name="document-text" style="font-size: 1.7rem" class="text-success mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <a href="/presensi/izin" style="color: black">
                        <div class="card-body text-center" style="padding: 16px 12px !important line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:0%; right:1%; font-size:0.5rem; z-index:999">{{ $rekappresensi->jmlsakit }}</span>
                            <ion-icon name="medkit" style="font-size: 1.7rem" class="text-danger mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <a href="/presensi/izin" style="color: black">
                        <div class="card-body text-center" style="padding: 16px 12px !important line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:0%; right:1%; font-size:0.5rem; z-index:999">{{ $rekappresensi->jmlcuti }}</span>
                            <ion-icon name="calendar" style="font-size: 1.7rem" class="text-warning mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Cuti</span>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Daftar Hadir
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <style>
                        .historicontent {
                            display: flex;
                        }
                        .datapresensi {
                            margin-left: 10px;
                        }
                    </style>
                    @foreach($historibulan as $d)
                    @if ($d->status == "h")
                    <div class="card mb-1">
                        <div class="card-body">
                            <div class="historicontent">
                                <div class="iconpresensi">
                                    <ion-icon name="finger-print-outline" style="font-size: 48px;" class="text-success"></ion-icon>
                                </div>
                                <div class="datapresensi">
                                    <h3 style="line-height: 3px">Presensi</h3>
                                    <h4 style="margin: 0px !important">{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</h4>
                                    <span style="margin-right: 5px !important">{{ $d->jam_in }}</span>
                                    <span> - </span>
                                    <span style="margin-left: 5px !important">{{ $d->jam_out != null ? $d->jam_out : 'Belum Presensi'}}</span>
                                    <br>
                                    <span>
                                        @if($d->jam_in >= '08:00')
                                        <span class="text-danger">Terlambat</span>
                                        @else
                                        <span class="text-success">Tepat Waktu</span>
                                        @endif
                                    </span> 
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif ($d->status == "i")
                    <div class="card mb-1">
                        <div class="card-body">
                            <div class="historicontent">
                                <div class="iconpresensi">
                                    <ion-icon name="document-outline" style="font-size: 48px;" class="text-primary"></ion-icon>
                                </div>
                                <div class="datapresensi">
                                    <h3 style="line-height: 3px">Izin - {{ $d->kode_izin }}</h3>
                                    <h4 style="margin: 0px !important">{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</h4>
                                    <span style="margin-right: 5px !important">{{ $d->keterangan }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif ($d->status == "s")
                    <div class="card mb-1">
                        <div class="card-body">
                            <div class="historicontent">
                                <div class="iconpresensi">
                                    <ion-icon name="medkit-outline" style="font-size: 48px;" class="text-danger"></ion-icon>
                                </div>
                                <div class="datapresensi">
                                    <h3 style="line-height: 3px">Sakit - {{ $d->kode_izin }}</h3>
                                    <h4 style="margin: 0px !important">{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</h4>
                                    <span style="margin-right: 5px !important">{{ $d->keterangan }}</span>
                                    <br>
                                        @if(!empty($d->doc_sid))
                                        <span style="color: blue">
                                        <ion-icon name="document-attach-outline"></ion-icon>SID
                                        </span>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif ($d->status == "c")
                    <div class="card mb-1">
                        <div class="card-body">
                            <div class="historicontent">
                                <div class="iconpresensi">
                                    <ion-icon name="calendar-outline" style="font-size: 48px;" class="text-warning"></ion-icon>
                                </div>
                                <div class="datapresensi">
                                    <h3 style="line-height: 3px">Cuti - {{ $d->kode_cuti }}</h3>
                                    <h4 style="margin: 0px !important">{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</h4>
                                    <span style="margin-right: 5px !important" class="text-info">{{ $d->nama_cuti}}</span>
                                    <span style="margin-right: 5px !important">{{ $d->keterangan }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @endforeach
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        <li>
                            @foreach($daftarhadir as $d)
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>
                                        {{ $d->nama_lengkap }}
                                        <small class="text-muted">{{ $d->pangkat }}</small>
                                    </div>
                                    <span class="badge {{ $d->jam_in < "08:00" ? "bg-success" : "bg-danger" }}">{{ $d->jam_in }}</span>
                                </div>
                            </div>
                            @endforeach
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- * App Capsule -->
@endsection