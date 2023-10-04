@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Jabatan
          </div>
          <h2 class="page-title">
            Data Jabatan
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
                     @php
                     if(Session::get('success')){
                       echo '<div class="alert alert-success">'.Session::get('success').'</div>';
                     }elseif(Session::get('error')){
                        echo '<div class="alert alert-danger">'.Session::get('error').'</div>';
                      }
                     @endphp
                  </div>
                    <div class="row">
                      <div class="col-12">
                        <a href="#" class="btn btn-primary" id="btnTambahJabatan">
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
                      <form action="#" method="GET">
                        <div class="row">
                          <div class="col-10">
                            <div class="form-group">
                              <input type="text" name="nama_jab" id="nama_jab" class="form-control" 
                              placeholder="Jabatan" value="{{ Request('nama_jab') }}">
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
                                <th>Kode Jabatan</th>
                                <th>Nama Jabatan</th>
                                <th>Aksi</th>
                            </tr>   
                        </thead>
                        <tbody>
                            @foreach ($jabatan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_jab }}</td>
                                    <td>{{ $item->nama_jab }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="edit btn btn-info btn-sm" kode_jab="{{ $item->kode_jab }}">
                                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                              <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                              <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                              <path d="M16 5l3 3"></path>
                                           </svg>
                                            </a>
                                            <form action="/Jabatan/{{ $item->kode_jab }}/delete" method="POST" style="margin-left:5px">
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>
        </div>
    </div>
  </div>
  <div class="modal modal-blur fade" id="modal-inputjabatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Jabatan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/jabatan/store" method="POST" id="formjabatan">
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
                  <input type="text" id="nik" value="" class="form-control" name="kode_jab" placeholder="Kode_Jabatan">
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
                  <input type="text" id="nama_jab" value="" name="nama_jab" class="form-control" placeholder="Nama Jabatan">
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

  <div class="modal modal-blur fade" id="modal-editjabatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Jabatan</h5>
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
    $("#btnTambahjabatan").click(function(){
      $("#modal-inputjabatan").modal("show");
    });

    $(".edit").click(function(){
      var kode_jab = $(this).attr('kode_jab');
      $.ajax({
        type: 'POST',
        url: '/Jabatan/edit',
        cache:false,
        data: {
          _token: '{{ csrf_token(); }}',
          kode_jab: kode_jab
        },
        success: function(respond){
          $("#loadeditform").html(respond);
        }
      });
      $("#modal-editjabatan").modal("show");
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