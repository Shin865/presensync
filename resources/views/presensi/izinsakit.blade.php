@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
            <!-- Page pre-title -->
          <h2 class="page-title">
            Data Izin / Sakit
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
             @if(Session::get('success'))
             <div class="alert alert-success">
              {{ Session::get('success') }}
            </div>
            @endif
            @if(Session::get('error'))
              <div class="alert alert-danger">
                {{ Session::get('error') }}
              </div>
            @endif
          </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="/presensi/izinsakit" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M16 3l0 4"></path>
                                        <path d="M8 3l0 4"></path>
                                        <path d="M4 11l16 0"></path>
                                        <path d="M8 15h2v2h-2z"></path>
                                     </svg>
                                </span>
                                <input type="text" id="dari" value="{{ Request('dari') }}" class="form-control" name="dari" placeholder="Dari">
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M16 3l0 4"></path>
                                        <path d="M8 3l0 4"></path>
                                        <path d="M4 11l16 0"></path>
                                        <path d="M8 15h2v2h-2z"></path>
                                     </svg>
                                </span>
                                <input type="text" id="sampai" value="{{ Request('sampai') }}" class="form-control" name="sampai" placeholder="Sampai">
                              </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                            <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                            <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                            <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                            <path d="M5 11h1v2h-1z"></path>
                            <path d="M10 11l0 2"></path>
                            <path d="M14 11h1v2h-1z"></path>
                            <path d="M19 11l0 2"></path>
                         </svg>
                    </span>
                    <input type="text" id="nik" value="{{ Request('nik') }}" class="form-control" name="nik" placeholder="NIK">
                  </div>
            </div>
            <div class="col-3">
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                         </svg>
                    </span>
                    <input type="text" id="nama_lengkap" value="{{ Request('nama_lengkap') }}" class="form-control" name="nama_lengkap" placeholder="Nama Karyawan">
                  </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select name="status_approved" id="status_approved" class="form-select">
                        <option value="">Pilih Status</option>
                        <option value="0" {{ Request('status_approved') == '0' ? 'selected' : "" }}>Pending</option>
                        <option value="1" {{ Request('status_approved') == '1' ? 'selected' : "" }}>Disetujui</option>
                        <option value="2" {{ Request('status_approved') == '2' ? 'selected' : "" }}>Ditolak</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                            <path d="M21 21l-6 -6"></path>
                         </svg>
                         Cari  
                    </button>
                </div>
            </div>
        </div>
    </form>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Izin</th>
                            <th>NIK</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>pangkat</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Status Approve</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izinsakit as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_izin }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ date('d-m-Y',strtotime($item->tgl_izin_dari)) }} s/d {{ date('d-m-Y',strtotime($item->tgl_izin_sampai)) }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->pangkat }}</td>
                                @if($item->status == "i")
                                <td>Izin</td>
                                @elseif($item->status == "s")
                                <td>Sakit</td>
                                @elseif($item->status == "c")
                                <td>Cuti</td>
                                @endif
                                </td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    @if ($item->status_approved == "0")
                                        <span class="badge bg-warning" style="color:white">Pending</span>
                                    @elseif($item->status_approved == "1")
                                        <span class="badge bg-success" style="color:white">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger" style="color:white">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status_approved == "0")
                                    <a href="#" class="btn btn-sm btn-primary approve" kode_izin="{{ $item->kode_izin }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-external-link" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"></path>
                                            <path d="M11 13l9 -9"></path>
                                            <path d="M15 4h5v5"></path>
                                         </svg>
                                         Aksi
                                    </a>
                                    @else
                                    <a href="/presensi/{{ $item->kode_izin}}/batalkanizin" class="btn btn-sm btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                        Batalkan
                                    </a>
                                    @endif
                                </td>
                            </tr>   
                        @endforeach
                </table>
                {{ $izinsakit->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
  </div>
  <div class="modal modal-blur fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Izin/Sakit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/presensi/approveizin" method="POST">
                @csrf
                <input type="hidden" id="kode_izin_form" name="kode_izin_form">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <select name="status_approved" id="status_approve" class="form-select">
                                <option value="1">Disetujui</option>
                                <option value="2">Ditolak</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 14l11 -11"></path>
                                    <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                                 </svg>
                                 Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('myscript')
<script>
    $(function() {
        $('.approve').click(function(e){
            e.preventDefault();
            var kode_izin = $(this).attr('kode_izin');
            $('#kode_izin_form').val(kode_izin);
            $('#modal-izinsakit').modal('show');
        });

        $("#dari, #sampai").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
        format: 'yyyy-mm-dd'
        });

    });
</script>
@endpush