@extends('layouts.presensi')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-modal {
        max-height: 400px !important;
    }
    .datepicker-controls .select-month input {
        width: 100px;
    }
    .datepicker-date-display {
        background-color: #0f3a7e !important;
    }
    .datepicker-cancel, .datepicker-clear, .datepicker-today, .datepicker-done {
        color: #0f3a7e !important;
    }
    .datepicker-table td.is-today {
        color: #000000 !important;
        border: 1px solid #0f3a7e !important;
    }
    .datepicker-table td.is-selected {
        background-color: #0043ae !important;
        color: #fff;
    }
    .dropdown-content li>a, .dropdown-content li>span {
        color: #232323;
    }
</style>
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Formulir Izin</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
<div class="row" style="margin-top:70px">
    <div class="col">
        <form method="POST" action="/presensi/storeizin" id="formizin">
            @csrf
            <div class="form-group">
                <input type="text" id="tgl_izin" name="tgl_izin" class="form-control datepicker" placeholder="Tanggal" autocomplete="off">
            </div>
            <div class="form-group">
                <select name="status" id="status" class="form-control">
                    <option value="" disabled selected>Pilih Jenis Izin</option>
                    <option value="i">Izin</option>
                    <option value="s">Sakit</option>
                </select>
            </div>
            <div class="form-group">
                <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Kirim</button>
        </form>
    </div>
</div>
@endsection
@push('myscript')
<script>
    var currYear = (new Date()).getFullYear();

    $(document).ready(function() {
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd"    
        });

        $("#tgl_izin").change(function() {
            var tgl_izin = $(this).val();
            $.ajax({
                type: "POST",
                url: "/presensi/cekizin",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "tgl_izin": tgl_izin
                },
                cache: false,
                success: function(respond) {
                    if(respond > 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Anda sudah mengajukan izin pada tanggal tersebut',
                            showConfirmButton: false,
                            timer: 1500,
                        }).then((result) => {
                            $("#tgl_izin").val("");
                        });
                    }
                }
            });
        });

        $("#formizin").submit(function(e) {
            var tgl_izin = $("#tgl_izin").val();
            var status = $("#status").val();
            var keterangan = $("#keterangan").val();
            if(tgl_izin == "" || status == "" || keterangan == "") {
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