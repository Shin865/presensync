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
        ->where('status', 'h')
        ->where('tgl_presensi', $hariini)
        ->first();
        $historibulan = DB::table('presensi')
        ->select('presensi.*', 'keterangan','doc_sid','master_cuti.*')
        ->leftJoin('pengajuan_izin', 'presensi.kode_izin', '=', 'pengajuan_izin.kode_izin')
        ->leftJoin('master_cuti', 'pengajuan_izin.kode_cuti', '=', 'master_cuti.kode_cuti')
        ->where('presensi.nik', $nik)
        ->whereRaw('MONTH(tgl_presensi) ="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_presensi) ="'.$tahunini.'"')
        ->orderBy('tgl_presensi','desc')
        ->get();
        
        $rekappresensi = DB::table('presensi')
        ->selectRaw('
        SUM(IF(status="h",1,0)) as jmlhadir,
        SUM(IF(status="i",1,0)) as jmlizin,
        SUM(IF(status="s",1,0)) as jmlsakit,
        SUM(IF(status="c",1,0)) as jmlcuti,
        SUM(IF(jam_in > "08:00",1,0)) as jmltelat')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi) ="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_presensi) ="'.$tahunini.'"')
        ->first();

        $daftarhadir = DB::table('presensi')
        ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
        ->leftJoin('admins', 'karyawan.id_admin', '=', 'admins.id_admin')
        ->orderBy('jam_in', 'ASC')
        ->where('karyawan.id_admin', Auth::guard('karyawan')->user()->id_admin)
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

        return view('dashboard.dashboard',compact ('presensihariini','historibulan','bln',
        'bulanini','tahunini','rekappresensi','daftarhadir'));
    }

    public function dashboardadmin(){

        $hariini = date('Y-m-d');
             
                // Ambil id admin dari sesi
                $adminId = session()->get('id_admin');
             
                // Gunakan relasi untuk mendapatkan data karyawan yang terkait dengan admin
                $karyawans = Admin::find($adminId)->karyawans;
            
                // Inisialisasi variabel untuk menyimpan hasil rekapan
                $rekappresensi = [
                    'jmlhadir' => 0,
                ];
                $rekapizin = [
                    'jmlizin' => 0,
                    'jmlsakit' => 0,
                    'jmlcuti' => 0,
                ];
            
                // Loop melalui karyawan dan tambahkan rekapan mereka
                foreach ($karyawans as $karyawan) {
                    $presensi = DB::table('presensi')
                        ->selectRaw('SUM(IF(status="h",1,0)) as jmlhadir, SUM(IF(jam_in > "08:00",1,0)) as jmltelat')
                        ->where('tgl_presensi', $hariini)
                        ->where('nik', $karyawan->nik)
                        ->first();
            
                    // Tambahkan rekapan presensi karyawan
                    $rekappresensi['jmlhadir'] += $presensi->jmlhadir;
            
                    $izin = DB::table('pengajuan_izin')
                        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit,SUM(IF(status="c",1,0)) as jmlcuti')
                        ->where('tgl_izin_dari', $hariini)
                        ->where('nik', $karyawan->nik)
                        ->where('status_approved', 1)
                        ->first();
            
                    // Tambahkan rekapan izin karyawan
                    $rekapizin['jmlizin'] += $izin->jmlizin;
                    $rekapizin['jmlsakit'] += $izin->jmlsakit;
                    $rekapizin['jmlcuti'] += $izin->jmlcuti;
                }
            
                return view('dashboard.dashboardadmin', compact('rekappresensi', 'rekapizin'));
    }

    public function dashboardcontrol(Request $request){
        $admin = DB::table('admins')
        ->orderBy('nama_admin');
        if(!empty($request->nama_admin)){
            $admin = DB::table('admins')->where('nama_admin','like','%'.$request->nama_admin.'%');
        }
        if($request->status != ""){
            $admin = DB::table('admins')->where('status', $request->status);
        }
        $admins = $admin->paginate(5);
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
