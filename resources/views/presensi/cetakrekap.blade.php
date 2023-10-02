<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Cetak Laporan</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
  @page 
  {
    size: A4 
    }

    #title{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 18px;
        font-weight: bold;
    }
    .tabeldatakaryawan{
        margin-top: 40px;
    }
    .tabeldatakaryawan td{
        padding: 5px;
    }
    .tabelpresensi{
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse
    }
    .tabelpresensi> tr, th{
        border: 2px solid black;
        padding: 5px;
        background-color: #c1c1c1;
        font-size: 10px
    }
    .tabelpresensi td{
        border: 2px solid black;
        padding: 5px;
        font-size: 10px
    }
    .foto{
        width: 40px;
        height: 30px;
    }
</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape">

    <?php
    function selisih($jam_masuk, $jam_keluar)
    {
        list($h, $m, $s) = explode(":", $jam_masuk);
        $dtAwal = mktime($h, $m, $s, "1", "1", "1");
        list($h, $m, $s) = explode(":", $jam_keluar);
        $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
        $dtSelisih = $dtAkhir - $dtAwal;
        $totalmenit = $dtSelisih / 60;
        $jam = explode(".", $totalmenit / 60);
        $sisamenit = ($totalmenit / 60) - $jam[0];
        $sisamenit2 = $sisamenit * 60;
        $jml_jam = $jam[0];
        return $jml_jam . ":" . round($sisamenit2);
    }
?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

   <table style="width: 100%">
    <tr>
        <td style="width: 30px">
            <img src="{{ asset('/tabler/static/logo.png')}}" alt="" width="80" height="80">
        </td>
        <td>
            <span id="title">
            REKAP PRESENSI KARYAWAN<br>
            PERIODE {{ strtoupper($bln[$bulan]) }} {{ $tahun }}<br>
            PT. HIU TERBANG<br>
            </span>
            <span style="mt-1"><i>Jln. Concat</i></span>
        </td>
    </tr>
   </table>
   <table class="tabelpresensi">
    <tr>
        <th rowspan="2">NIK</th>
        <th rowspan="2">Nama</th>
        <th colspan="31">Tanggal</th>
        <th rowspan="2">TH</th>
        <th rowspan="2">TT</th>
    </tr>
    <tr>
    <?php
    for($i=1;$i<=31;$i++){
    ?>
    <th>{{ $i }}</th>
    <?php
    }
    ?>
    </tr>
    @foreach ($rekap as $item)
        <tr>
            <td>{{ $item->nik }}</td>
            <td>{{ $item->nama_lengkap }}</td>
            <?php
            $totalhadir = 0;
            $totaltelat = 0;
            for($i=1;$i<=31;$i++){
                $tgl = "tgl_".$i;
                if(empty($item->$tgl)){
                    $hadir[0] = "";
                    $hadir[1] = "";
                }else {
                    $hadir = explode("-",$item->$tgl);
                    $totalhadir++;
                    if($hadir[0] > "07:00:00"){
                        $totaltelat++;
                    }
                }
            ?>
            <td>
                <span style="color:{{ $hadir[0] > "07:00:00" ? "red" : "" }}">{{ $hadir[0] }}</span><br>
                <span style="color:{{ $hadir[1] < "16:00:00" ? "red" : "" }}">{{ $hadir[1] }}</span><br>
            </td>
            <?php
            }
            ?>
            <td>{{ $totalhadir }}</td>
            <td>{{ $totaltelat }}</td>
        </tr>
    @endforeach
   </table>

    <table width="100%" style="margin-top:100px">
        <tr>
            <td></td>
            <td style="text-align: center">Yogyakarta, {{ date('d-m-Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align:bottom" height="100px">
                <u>Calorina Pavlofa</u><br>
                <i><b>HRD Manager</b></i>
            </td>
            <td style="text-align: center; vertical-align:bottom" height="100px">
                <u>SentoMaru</u><br>
                <i><b>IT Manager</b></i>
            </td>
        </tr>
    </table>
  </section>

</body>

</html>