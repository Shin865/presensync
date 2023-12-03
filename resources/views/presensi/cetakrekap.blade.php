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
            {{ $admin->nama_admin }}<br>
            </span>
        </td>
    </tr>
   </table>
   <table class="tabelpresensi">
    <tr>
        <th rowspan="2">NIK</th>
        <th rowspan="2">Nama</th>
        <th colspan="{{ $jmlhari }}">{{ $bln[$bulan] }} {{ $tahun }}</th>
        <th rowspan="2">H</th>
        <th rowspan="2">I</th>
        <th rowspan="2">S</th>
        <th rowspan="2">A</th>
    </tr>
    <tr>
        @foreach ($rangetanggal as $d)
        @if($d != NULL)
        <th>{{ date('d', strtotime($d)) }}</th>
        @endif
        @endforeach
    </tr>
    @foreach ($rekap as $item)
        <tr>
            <td>{{ $item->nik }}</td>
            <td>{{ $item->nama_lengkap }}</td>
                <?php
                    $jml_hadir = 0;
                    $jml_izin = 0;
                    $jml_sakit = 0;
                    $jml_alpha = 0;
                    $jml_cuti = 0;
                    $color = "";
                    for($i=1; $i<=$jmlhari; $i++){
                        $tgl = "tgl_".$i;  
                        $datapresensi = explode("|", $item->$tgl);
                        if($item->$tgl != NULL){
                        $status = $datapresensi[2];
                        }else{
                        $status = "";
                        }

                        if($status == "h"){
                            $jml_hadir++;
                            $color = "white";
                        }elseif($status == "i"){
                            $jml_izin++;
                            $color = "yellow";
                        }elseif($status == "s"){
                            $jml_sakit++;
                            $color = "orange";
                        }elseif($status == "c"){
                            $jml_cuti++;
                            $color = "grey";
                        }elseif(empty($status)){
                            $color = "red";
                            $jml_alpha++;
                        }
                ?>
                <td style="background-color: {{ $color }}">
                    {{ $status }}
                </td>
                <?php
                    }
                ?>
            <td>{{ !empty($jml_hadir) ? $jml_hadir : "" }}</td>
            <td>{{ !empty($jml_izin) ? $jml_izin : "" }}</td>
            <td>{{ !empty($jml_sakit) ? $jml_sakit : "" }}</td>
            <td>{{ !empty($jml_alpha) ? $jml_alpha : "" }}</td>

        </tr>
    @endforeach
   </table>

   <table width="100%" style="margin-top:100px; margin-left:800px">
        <tr>
            <td colspan="2" style="text-align: left">Yogyakarta, {{ date('d') }} {{ ($bln[$bulan]) }} {{ $tahun }}<br>
            Kepala Sekolah
            <br><br><br><br><br>
            ............................................
        </td>
        </tr>
    </table>
  </section>

</body>

</html>