@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Presensi</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
<style>
    .webcame-capture, .webcame-capture video {
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 20px;
        
    }

    #map { 
        height: 200px; 
    }

</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection
@section('content')
<div class="row" style="margin-top: 5%">
   <div class="col">
        <input type="hidden" id="lokasi">
        <div class="webcame-capture"></div>
   </div>
</div>
<div class="row" style="margin-top: 10px">
    <div class="col">
        @if($cek > 0)
        <button id="takeabsen" class="btn btn-danger btn-block btn-lg">
            <ion-icon name="camera-outline"></ion-icon>
            Absen Pulang</button>
        @else
        <button id="takeabsen" class="btn btn-primary btn-block btn-lg">
            <ion-icon name="camera-outline"></ion-icon>
            Absen Masuk</button>
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="col">
        <div id="map"></div>
    </div>
</div>
@endsection

@push('myscript')
    <script>
        Webcam.set({
            width: 640,
            height: 480,
            
            image_format: 'jpeg',
            jpeg_quality: 80
        });
        Webcam.attach('.webcame-capture');

        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
            lokasi.value = "Geolocation is not supported by this browser.";
        }

        function successCallback(position) {
            lokasi.value = position.coords.latitude + "," + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);
            var lokasi_kantor = "{{ $lok_kantor->lokasi_kantor }}";
            var lok = lokasi_kantor.split(",");
            var lat_kantor = lok[0];
            var long_kantor = lok[1];
            var radius = "{{ $lok_kantor->radius }}";
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            //Ganti Kordinat tujuan
            var circle = L.circle([lat_kantor,long_kantor], {
            //--------------------------------------------------------------------
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);

        }

        function errorCallback(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    lokasi.value = "User denied the request for Geolocation."
                    break;
                case error.POSITION_UNAVAILABLE:
                    lokasi.value = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    lokasi.value = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    lokasi.value = "An unknown error occurred."
                    break;
            }
        }

        $('#takeabsen').click(function(e){
            Webcam.snap(function(data_uri) {
                image = data_uri;
            });
            var lokasi = $('#lokasi').val();
            $.ajax({
                url: "/presensi/store",
                type: "POST",
                data: {
                        _token: "{{ csrf_token() }}",
                        image: image,
                        lokasi: lokasi
                    },
                cache : false,
                success: function(respond) {
                    var status = respond.split("|");
                    if(status[0] == "success"){
                        swal.fire({
                            title: "Berhasil",
                            text: status[1],
                            icon: "success",
                            buttons: false,
                            timer: 2000
                        }).then(function() {
                            window.location = "/dashboard";
                        });
                    }else{
                        swal.fire({
                            title: "Gagal",
                            text: status[1],
                            icon: "error",
                            buttons: false,
                            timer: 2000
                        }).then(function() {
                            window.location = "/presensi/create";
                        });
                    }}
                });
            }); 
    </script>
@endpush