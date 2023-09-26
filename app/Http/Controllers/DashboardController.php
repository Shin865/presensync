<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date('Y-m-d');
        $bulanini = date('m') * 1;
        $tahunini = date('Y');
        $nik = Auth::guard('karyawan')->user()->nik;
        $presensihariini = DB::table('presensi')
        ->where('nik', $nik)
        ->where('tgl_presensi', $hariini)
        ->first();
        $historibulan = DB::table('presensi')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi) ="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_presensi) ="'.$tahunini.'"')
        ->orderBy('tgl_presensi')
        ->get();
        
        $rekappresensi = DB::table('presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "07:00",1,0)) as jmltelat')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi) ="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_presensi) ="'.$tahunini.'"')
        ->first();

        $daftarhadir = DB::table('presensi')
        ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
        ->orderBy('jam_in', 'ASC')
        ->where('tgl_presensi', $hariini)
        ->get();
        $bln = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );

        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_izin) ="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_izin) ="'.$tahunini.'"')
        ->where('status_approved', 1)
        ->first();

        return view('dashboard.dashboard',compact ('presensihariini','historibulan','bln',
        'bulanini','tahunini','rekappresensi','daftarhadir','rekapizin'));
    }

    public function dashboardadmin(){
        $hariini = date('Y-m-d');
        $rekappresensi = DB::table('presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "07:00",1,0)) as jmltelat')
        ->where('tgl_presensi', $hariini)
        ->first();

        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('tgl_izin', $hariini)
        ->where('status_approved', 1)
        ->first();

        return view('dashboard.dashboardadmin',compact('rekappresensi','rekapizin'));
    }

}
