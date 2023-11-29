@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Histori</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="row" style="margin-top:65px">
            <div class="col-6">
                <div class="form-group">
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="">Bulan</option>
                        @for($i=1;$i<=12;$i++)
                        <option {{ Request('bulan') == $i ? 'selected' : '' }} value="{{ $i }}">{{ $bln[$i] }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">Tahun</option>
                        @for($i=2022;$i<=date("Y");$i++)
                        <option {{ Request('tahun') == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary btn-block" id="getdata">Cari Data</button>
                </div>
            </div>
    </div>
    </div>
        <div class="row mt-2" style="position: fixed; width: 100%; margin: auto; overflow-y:scroll; height: 430px">
            <div class="col" id="showhistori">
        </div>
    </div>
</div>

@endsection

@push('myscript')
    <script>
        $(function(){
            $('#getdata').click(function(e){
                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();
                $.ajax({
                    type: 'POST',
                    url: '/gethistori',
                    data: {
                        _token: "{{ csrf_token() }}",
                        bulan: bulan,
                        tahun: tahun,
                    },
                    cache: false,
                    success: function(respond){
                        $('#showhistori').html(respond);
                    }
                });
            });
        });
    </script>
@endpush