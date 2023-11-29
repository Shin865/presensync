@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Karyawan
          </div>
          <h2 class="page-title">
            Data Karyawan
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                        <a href="#" class="btn btn-primary" id="btnTambahkaryawan">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                         </svg>
                          Tambah Data
                        </a>
                      </div>
                    </div>
                  <div class="row mt-2">
                    <div class="col-12">
                      <form action="/karyawan" method="GET">
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group">
                              <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" placeholder="Cari Nama Karyawan" value="{{ Request('nama_karyawan') }}">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <select name="kode_jab" id="kode_jab" class="form-select">
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach ($jabatan as $item)
                                    <option {{ Request('kode_jab')==$item->kode_jab ? 'selected' : ''  }} value="{{ $item->kode_jab }}">{{ $item->nama_jab }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                  <path d="M21 21l-6 -6"></path>
                               </svg>
                               Cari
                              </button>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-12">
                      <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama Karyawan</th>
                                <th>Pangkat</th>
                                <th>No.HP</th>
                                <th>Foto</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>   
                        </thead>
                        <tbody>
                            @foreach ($karyawan as $item)
                            @php
                                $path = Storage::url('uploads/karyawan/'.$item->foto);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration + $karyawan->firstItem()-1 }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->pangkat }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>
                                    @if ( empty($item->foto) )
                                        <img src="{{ asset('assets/img/nophoto.png') }}" class="avatar" alt="">
                                    @else
                                        <img src="{{ url($path) }}" class="avatar" alt="">
                                    @endif
                                </td>
                                <td>{{ $item->nama_jab }}</td>
                                <td>
                                  <div class="d-flex">
                                    <div>
                                  <a href="#" class="edit btn btn-info btn-sm mr-3" nik="{{ $item->nik }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                 </svg>
                                  </a>
                                  <a href="/karyawan/{{ Crypt::encrypt($item->nik) }}/resetpassword" class="btn btn-sm btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10.17 6.159l2.316 -2.316a2.877 2.877 0 0 1 4.069 0l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.33 2.33" />
                                    <path d="M14.931 14.948a2.863 2.863 0 0 1 -1.486 -.79l-.301 -.302l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.863 2.863 0 0 1 -.794 -1.504" />
                                    <path d="M15 9h.01" />
                                    <path d="M3 3l18 18" />
                                  </svg>
                                </a>
                                    </div>
                                  <div>
                                  <form action="/karyawan/{{ $item->nik }}/delete" method="POST" style="margin-left:5px">
                                  @csrf
                                  <a class="btn btn-danger btn-sm delete-confirm"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 7l16 0"></path>
                                    <path d="M10 11l0 6"></path>
                                    <path d="M14 11l0 6"></path>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                 </svg>
                                  </a>
                                  </form>
                                  </div>
                                  </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $karyawan->links('vendor.pagination.bootstrap-5') }}
                    </div>
                  </div>
                </div>
        </div>
    </div>
  </div>
  <div class="modal modal-blur fade" id="modal-inputkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Karyawan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/karyawan/store" method="POST" id="formKaryawan" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3"></path>
                      <path d="M4 6v6c0 1.657 3.582 3 8 3c1.075 0 2.1 -.08 3.037 -.224"></path>
                      <path d="M20 12v-6"></path>
                      <path d="M4 12v6c0 1.657 3.582 3 8 3c.166 0 .331 -.002 .495 -.006"></path>
                      <path d="M16 19h6"></path>
                      <path d="M19 16v6"></path>
                   </svg>
                  </span>
                  <input type="text" id="nik" value="" class="form-control" name="nik" placeholder="NIK">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    </svg>
                  </span>
                  <input type="text" id="nama_lengkap" value="" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap">
                </div>
              </div>
            </div>
    <div class="row">
      <div class="col-12">
        <div class="input-icon mb-3">
          <span class="input-icon-addon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-accessible" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
              <path d="M10 16.5l2 -3l2 3m-2 -3v-2l3 -1m-6 0l3 1"></path>
              <circle cx="12" cy="7.5" r=".5" fill="currentColor"></circle>
           </svg>
          </span>
          <input type="text" id="pangkat" value="" class="form-control" name="pangkat" placeholder="pangkat">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="input-icon mb-3">
          <span class="input-icon-addon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
              <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
              <path d="M9 12a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1"></path>
           </svg>
          </span>
          <input type="text" id="no_hp" value="" class="form-control" name="no_hp" placeholder="No.HP">
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-12">
        <input type="file" name="foto" class="form-control">
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-12">
        <select name="kode_jab" id="kode_jab" class="form-select">
          <option value="">-- Pilih Jabatan --</option>
          @foreach ($jabatan as $item)
          <option {{ Request('kode_jab')==$item->kode_jab ? 'selected' : ''  }} value="{{ $item->kode_jab }}">{{ $item->nama_jab }}</option>
          @endforeach
        </select>
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

  <div class="modal modal-blur fade" id="modal-editkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Karyawan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadeditform">
          
        </div>
      </div>
    </div>
  </div>
@endsection

@push('myscript')
<script>
  $(function(){
    $("#nik").mask("00000");
    $("#no_hp").mask("0000000000000");
    $("#btnTambahkaryawan").click(function(){
      $("#modal-inputkaryawan").modal("show");
    });

    $(".edit").click(function(){
      var nik = $(this).attr('nik');
      $.ajax({
        type: 'POST',
        url: '/karyawan/edit',
        cache:false,
        data: {
          _token: '{{ csrf_token(); }}',
          nik: nik
        },
        success: function(respond){
          $("#loadeditform").html(respond);
        }
      });
      $("#modal-editkaryawan").modal("show");
    });

    $(".delete-confirm").click(function(e){
      var form = $(this).closest("form");
      e.preventDefault();
      Swal.fire({
        title: 'Yakin ?',
        text: "Apakah Anda Yakin Ingin Menghapus Data Ini",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
          Swal.fire(
            'Deleted!',
            'Data Berhasil Di Hapus',
            'success'
          )
        }
      })
    });
    $("#formKaryawan").submit(function(){
      var nik = $("#nik").val();
      var nama_lengkap = $("#nama_lengkap").val();
      var pangkat = $("#pangkat").val();
      var no_hp = $("#no_hp").val();
      var kode_jab = $("formKaryawan").find("#kode_jab").val();
      if(nik == "" || nama_lengkap == "" || pangkat == "" || no_hp == "" || kode_jab == "") {
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
@endpush