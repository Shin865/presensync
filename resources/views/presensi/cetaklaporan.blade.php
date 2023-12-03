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
        margin-top: 10px;
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
    }
    .tabelpresensi td{
        border: 2px solid black;
        padding: 5px;
    }
    .foto{
        width: 40px;
        height: 30px;
    }
</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

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
            LAPORAN PRESENSI KARYAWAN<br>
            PERIODE {{ strtoupper($bln[$bulan]) }} {{ $tahun }}<br>
            {{ $admin->nama_admin }}<br>
            </span>
        </td>
    </tr>
   </table>
   <table class="tabeldatakaryawan">
    <tr>
        <td rowspan="6">
            @php
                $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
            @endphp
            <img src="{{ url($path) }}" alt="" width="130" height="150">
        </td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{ $karyawan->nik }}</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $karyawan->nama_lengkap }}</td>
    </tr>
    <tr>
        <td>pangkat</td>
        <td>:</td>
        <td>{{ $karyawan->pangkat }}</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ $karyawan->nama_jab }}</td>
    </tr>
    <tr>
        <td>No.HP</td>
        <td>:</td>
        <td>{{ $karyawan->no_hp }}</td>
    </tr>
   </table>
    <table class="tabelpresensi">
          <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Foto</th>
                <th>Jam Keluar</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Jml Jam</th>
          </tr>
          @foreach ($presensi as $item)
          @if ($item->status == 'h')
            @php
                $path_in = Storage::url('uploads/absensi/'.$item->foto_in);
                $path_out = Storage::url('uploads/absensi/'.$item->foto_out);
                $jamtelat = selisih('07:00:00', $item->jam_in);
            @endphp
                <tr>
                 <td>{{ $loop->iteration }}</td>
                 <td>{{ date("d-m-Y",strtotime($item->tgl_presensi)) }}</td>
                 <td>{{ $item->jam_in }}</td>
                 <td>
                    <img src="{{ url($path_in) }}" alt="" class="foto"></td>
                 <td>{{ $item->jam_out != null ? $item->jam_out : 'Belum Absen' }}</td>
                 <td>
                    @if ($item->jam_out != null)
                        <img src="{{ url($path_out) }}" alt="" class="foto">
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M13.5 20h-8.5a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v4"></path>
                        <path d="M9 13a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                        <path d="M22 22l-5 -5"></path>
                        <path d="M17 22l5 -5"></path>
                     </svg>
                    @endif
                </td>
                <td style="text-align: center">{{ $item->status }}</td>
                 <td>
                    @if ($item->jam_in > '07:00:00')
                        Terlambat ({{ $jamtelat }})
                    @else
                        Tepat Waktu
                    @endif
                 </td>
                    <td>
                        @if ($item->jam_out != null)
                        @php
                            $jmljamkerja = selisih($item->jam_in, $item->jam_out)
                        @endphp
                        @else
                            @php
                                $jmljamkerja = 0;
                            @endphp
                        @endif
                        {{ $jmljamkerja }}
                    </td>
                </tr>
            @else
                <tr>
                 <td>{{ $loop->iteration }}</td>
                 <td>{{ date("d-m-Y",strtotime($item->tgl_presensi)) }}</td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td style="text-align: center">{{ $item->status }}</td>
                 <td>{{ $item->keterangan }}</td>
                <td></td>
                </tr>
            @endif
          @endforeach
    </table>
    <table width="100%" style="margin-top:100px; margin-left:500px">
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