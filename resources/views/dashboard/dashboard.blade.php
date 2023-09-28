@extends('layouts.presensi')
@section('content')
<!-- App Capsule -->
<div id="appCapsule">
    <div class="section" id="user-section">
        <div class="row">
        <div class="col-12">
        <div id="user-detail">
            <div class="avatar">
                @if(!empty(Auth::guard('karyawan')->user()->foto))
                @php
                    $path = Storage::url('uploads/karyawan/'.Auth::guard('karyawan')->user()->foto)
                @endphp
                <img src="{{ url($path) }}" alt="avatar" class="imaged w64" style="height: 85%">
                @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                @endif
            </div>
            <div id="user-info">
                <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h2>
                <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>
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
                                    <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $presensihariini != null ? $presensihariini->jam_in : 'Belum Absen'}}</span>
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
                                    <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>{{ $presensihariini != null && $presensihariini->jam_out != null ? $presensihariini->jam_out : 'Belum Absen'}}</span>
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
                        <div class="card-body text-center" style="padding: 16px 12px !important line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:0%; right:1%; font-size:0.5rem; z-index:999">{{ $rekappresensi->jmlhadir }}</span>
                            <ion-icon name="accessibility" style="font-size: 1.7rem" class="text-primary mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:0%; right:1%; font-size:0.5rem; z-index:999">{{ $rekapizin->jmlizin }}</span>
                            <ion-icon name="document-text" style="font-size: 1.7rem" class="text-success mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:0%; right:1%; font-size:0.5rem; z-index:999">{{ $rekapizin->jmlsakit }}</span>
                            <ion-icon name="medkit" style="font-size: 1.7rem" class="text-warning mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:0%; right:1%; font-size:0.5rem; z-index:999">{{ $rekappresensi->jmltelat }}</span>
                            <ion-icon name="alarm" style="font-size: 1.7rem" class="text-danger mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.6rem; font-weight:500">Terlambat</span>
                        </div>
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
                    <ul class="listview image-listview">
                        @foreach($historibulan as $d)
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="image-outline" role="img" class="md hydrated"
                                        aria-label="image outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</div>
                                    <span class="badge badge-success">{{ $d->jam_in }}</span>
                                    <span class="badge badge-danger">{{ $d->jam_out != null ? $d->jam_out : 'Belum Absen'}}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
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
                                        <small class="text-muted">{{ $d->jabatan }}</small>
                                    </div>
                                    <span class="badge {{ $d->jam_in < "07:00" ? "bg-success" : "bg-danger" }}">{{ $d->jam_in }}</span>
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