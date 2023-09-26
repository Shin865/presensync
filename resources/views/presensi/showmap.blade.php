<style>
    #map { 
        height: 300px;
    }
</style>
<div id="map"></div>
<script>
    var lokasi = "{{ $presensi->lokasi_in }}";
    var lok = lokasi.split(",");
    var lat = lok[0];
    var lng = lok[1];
    var map = L.map('map').setView([lat,lng], 15);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var marker = L.marker([lat,lng]).addTo(map);
    //ganti koordinat kantor
    var circle = L.circle([lat,lng], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 20
    }).addTo(map);

    var popup = L.popup()
    .setLatLng([lat,lng])
    .setContent("{{ $presensi->nama_lengkap }}")
    .openOn(map);

</script>