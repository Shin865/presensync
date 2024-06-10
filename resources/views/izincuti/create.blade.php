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
    <div class="pageTitle">Formulir Izin Cuti</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
<div class="row" style="margin-top:70px">
    <div class="col">
        <form method="POST" action="/izincuti/store" id="formizin">
            @csrf
            <div class="form-group">
                <input type="text" id="tgl_izin_dari" name="tgl_izin_dari" class="form-control datepicker" placeholder="Tanggal Dari" autocomplete="off">
            </div>
            <div class="form-group">
                <input type="text" id="tgl_izin_sampai" name="tgl_izin_sampai" class="form-control datepicker" placeholder="Tanggal Sampai" autocomplete="off">
            </div>
            <div class="form-group">
                <input type="text" id="jml_hari" name="jml_hari" class="form-control" placeholder="Jumlah Hari" autocomplete="off" readonly>
            </div>
            <div class="form-group">
                <select name="kode_cuti" id="kode_cuti" class="form-control">
                    <option value="">Pilih Jenis Cuti</option>
                    @foreach( $mastercuti as $d)
                    <option value="{{ $d->kode_cuti }}">{{ $d->nama_cuti }}</option>
                    @endforeach
                </select>
            <div class="form-group" style="margin-top: 10px">
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

        function loadjumlahhari() {
            var dari = $( "#tgl_izin_dari").val();
            var sampai = $("#tgl_izin_sampai").val();
            var date1 = new Date(dari);
            var date2 = new Date(sampai);
            
            // To calculate the time difference of two dates 
            var Difference_In_Time = date2.getTime() - date1.getTime();
            // To calculate the no. of days between two dates 
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
            //To display the final no. of days (result)
            if (dari == "" || sampai == "") {
                var jmlhari = 0;
            }else{
                var jmlhari = Difference_In_Days + 1;
            }
            $("#jml_hari").val(jmlhari + " Hari");
        }
        $("#tgl_izin_dari, #tgl_izin_sampai").change(function(e) { 
            loadjumlahhari();
        });

    //    $("#tgl_izin").change(function() {
    //        var tgl_izin = $(this).val();
    //        $.ajax({
    //            type: "POST",
    //            url: "/presensi/cekizin",
    //            data: {
    //                "_token": "{{ csrf_token() }}",
    //                "tgl_izin": tgl_izin
    //            },
    //            cache: false,
    //            success: function(respond) {
    //                if(respond > 0) {
    //                    Swal.fire({
    //                        icon: 'error',
    //                        title: 'Gagal',
    //                        text: 'Anda sudah mengajukan izin pada tanggal tersebut',
    //                        showConfirmButton: false,
    //                        timer: 1500,
    //                    }).then((result) => {
    //                        $("#tgl_izin").val("");
    //                    });
    //                }
    //           }
    //        });
    //    });

        $("#formizin").submit(function(e) {
            var tgl_izin_dari = $("#tgl_izin_dari").val();
            var tgl_izin_sampai = $("#tgl_izin_sampai").val();
            var keterangan = $("#keterangan").val();
            var kode_cuti = $("#kode_cuti").val();
            if(tgl_izin_dari == "" || tgl_izin_sampai == "" || keterangan == "" || kode_cuti == "") {
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