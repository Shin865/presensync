<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
        ->select('presensi.*', 'keterangan','doc_sid','master_cuti.*')
        ->leftJoin('pengajuan_izin', 'presensi.kode_izin', '=', 'pengajuan_izin.kode_izin')
        ->leftJoin('master_cuti', 'pengajuan_izin.kode_cuti', '=', 'master_cuti.kode_cuti')
        ->where('presensi.nik', $nik)
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
        ->whereRaw('MONTH(tgl_izin_dari) ="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_izin_dari) ="'.$tahunini.'"')
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
        ->where('tgl_izin_dari', $hariini)
        ->where('status_approved', 1)
        ->first();

        return view('dashboard.dashboardadmin',compact('rekappresensi','rekapizin'));
    }

    public function dashboardcontrol(Request $request){
        $query = Admin::query();
        $query->select('admins.*');
        $query->orderBy('nama_admin');
        if(!empty($request->nama_admin)){
            $query->where('nama_admin','like','%'.$request->nama_admin.'%');
        }
        if($request->status != ""){
            $query->where('status', $request->status);
        }
        $admins = $query->paginate(5);
        return view('dashboard.dashboardcontrol',compact('admins'));
    }

    public function statusmitra(Request $request){
        $id_form = $request->id_form;
        $status = $request->status;
        $update = DB::table('admins')->where('id_admin', $id_form)->update(['status' => $status]);
        if($update){
            return redirect('/control/dashboardcontrol')->with(['success' => 'Data Berhasil di Update']);
         }else{
             return redirect('/control/dashboardcontrol')->with(['error' => 'Data Gagal di Update']);
         }
    }
    
    public function delete($id_admin){
        $delete = DB::table('admins')->where('id_admin',$id_admin)->delete();
        if($delete){
            return redirect('/control/dashboardcontrol')->with(['success' => 'Data Berhasil di Update']);
         }else{
             return redirect('/control/dashboardcontrol')->with(['error' => 'Data Gagal di Update']);
         }
    }

}
