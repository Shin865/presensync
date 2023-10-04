<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use App\Models\Pengajuanizin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class PresensiController extends Controller
{
    public function create()
    {
        $harini = date('Y-m-d');
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $harini)->count();
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        return view('presensi.create', compact('cek','lok_kantor'));
    }

    public function store(Request $request)
    { 
       $nik = Auth::guard('karyawan')->user()->nik;
       $tgl_presensi = date('Y-m-d');
       $jam = date('H:i:s');
       //lokasi Kantor
       $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
       $lok = explode(',', $lok_kantor->lokasi_kantor);
       $latitudekantor = $lok[0];
       $longitudekantor = $lok[1];
       //------------------------------------
       $lokasi = $request->lokasi;
       $lokasiuser = explode(',', $lokasi);
       $latitudeuser = $lokasiuser[0];
       $longitudeuser = $lokasiuser[1];
       $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
       $radius = $jarak['meters'];

       $cek = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $tgl_presensi)->count();
       if($cek > 0){
               $ket = "out";
         }else{
               $ket = "in";
         }
       $image = $request->image;
       $folderPath = "public/uploads/absensi/";
       $formatName = $nik."_".$tgl_presensi."_".$ket;
       $image_parts = explode(";base64,", $image);
       $image_base64 = base64_decode($image_parts[1]);
       $filename = $formatName.'.png';
       $file = $folderPath.$filename;

       
       if($radius > $lok_kantor->radius){
        echo "error|Maaf Anda Berada Diluar Radius, Jarak Anda Dengan Kantor Adalah ".$radius." Meter";
       }else{
        if($cek > 0){
            $data_pulang = array(
                'jam_out' => $jam,
                'foto_out' => $filename,
                'lokasi_out' => $lokasi,
              );
            $update = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $tgl_presensi)->update($data_pulang);
            if($update){
                echo "success|Terimakasih, Anda telah melakukan presensi pulang|out";
                Storage::put($file, $image_base64);
             }else{
                 echo "error|Maaf Absensi gagal dilakukan|out";
             }
       }else{
        $data = array(
            'nik' => $nik,
            'tgl_presensi' => $tgl_presensi,
            'jam_in' => $jam,
            'foto_in' => $filename,
            'lokasi_in' => $lokasi,
        );
        $simpan = DB::table('presensi')->insert($data);
           if($simpan){
               echo "success|Terimakasih, Anda telah melakukan presensi masuk|in";
               Storage::put($file, $image_base64);
            }else{
                echo "error|Maaf Absensi gagal dilakukan|in";
            }
       }
    }
}

     //Menghitung Jarak
     function distance($lat1, $lon1, $lat2, $lon2)
     {
         $theta = $lon1 - $lon2;
         $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
         $miles = acos($miles);
         $miles = rad2deg($miles);
         $miles = $miles * 60 * 1.1515;
         $feet = $miles * 5280;
         $yards = $feet / 3;
         $kilometers = $miles * 1.609344;
         $meters = $kilometers * 1000;
         return compact('meters');
     }

     public function editprofile()
     {
         $nik = Auth::guard('karyawan')->user()->nik;
         $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
         return view('presensi.editprofile', compact('karyawan'));
     }

     public function updateprofile(Request $request)
     {
         $nik = Auth::guard('karyawan')->user()->nik;
         $nama_lengkap = $request->nama_lengkap;
         $no_hp = $request->no_hp;
         $password = Hash::make($request->password);
         $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
         if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
         }else{
            $foto = $karyawan->foto;
         }
         if(empty($request->password)){
            $data = array(
                'nama_lengkap' =>$nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto
            );
         }else{
            $data = array(
                'nama_lengkap' =>$nama_lengkap,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto' => $foto
            );
         }
         $update = DB::table('karyawan')->where('nik', $nik)->update($data);
         if($update){
            if($request->hasFile('foto')){
               $folderPath = "public/uploads/karyawan/";
               $request->file('foto')->storeAs($folderPath, $foto);
            }
             return Redirect::back()->with(['success' => 'Data Berhasil di Update']);
         }else{
             return Redirect::back()->with(['error' => 'Data Gagal di Update']);
         }
     }

     public function histori(){
        $nik = Auth::guard('karyawan')->user()->nik;
        $historibulan = DB::table('presensi')
        ->where('nik', $nik)
        ->orderBy('tgl_presensi')
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
        return view('presensi.histori',compact ('historibulan','bln',));
     }

     public function gethistori(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;
        $histori = DB::table('presensi')
        ->whereRaw('MONTH(tgl_presensi) ="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi) ="'.$tahun.'"')
        ->where('nik', $nik)
        ->orderBy('tgl_presensi')
        ->get();

        return view('presensi.gethistori',compact ('histori'));
     }

    public function izin(){
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')->where('nik',$nik)->get();
        return view('presensi.izin',compact ('dataizin'));
    }

    public function buatizin(){
        return view('presensi.buatizin');
    }

    public function storeizin(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;
        $data = array(
            'nik' => $nik,
            'tgl_izin' => $tgl_izin,
            'status' => $status,
            'keterangan' => $keterangan,
        );
        $simpan = DB::table('pengajuan_izin')->insert($data);
        if($simpan){
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil di Simpan']);
         }else{
             return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan']);
         }
    }

    public function monitoring(){
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request){
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')->select('presensi.*','nama_lengkap','nama_jab')
        ->join('karyawan','karyawan.nik','=','presensi.nik')
        ->join('jabatan','jabatan.kode_jab','=','karyawan.kode_jab')
        ->where('tgl_presensi', $tanggal)
        ->get();

        return view('presensi.getpresensi',compact ('presensi'));
    }
    
    public function showmap(Request $request){
        $id = $request->id;
        $presensi = DB::table('presensi')->where('id', $id)
        ->join('karyawan','karyawan.nik','=','presensi.nik')
        ->first();
        return view('presensi.showmap',compact ('presensi'));
    }

    public function laporan(){

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
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
        return view('presensi.laporan',compact ('bln','karyawan'));
    }

    public function cetaklaporan(Request $request){
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $karyawan = DB::table('karyawan')->where('nik',$nik)
        ->join('jabatan','jabatan.kode_jab','=','karyawan.kode_jab')
        ->first();
        $presensi = DB::table('presensi')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi) ="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi) ="'.$tahun.'"')
        ->orderBy('tgl_presensi')
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
        if(isset($_POST['exportword'])){
            $time = date('H:i:s');
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename=Rekap Presensi ".$nik." ".$bln[$bulan]." ".$tahun." ".$time.".doc");
            return view('presensi.cetaklaporanword',compact ('presensi','bln','karyawan','bulan','tahun'));
        }

        return view('presensi.cetaklaporan',compact ('presensi','bln','karyawan','bulan','tahun'));
    }

    public function rekap(){

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
        
        return view('presensi.rekap',compact ('bln'));
    }

    public function cetakrekap(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $rekap = DB::table('presensi')
        ->selectRaw('presensi.nik, karyawan.nama_lengkap,
            MAX(IF(DAY(tgl_presensi) = 1,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_1,
            MAX(IF(DAY(tgl_presensi) = 2,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_2,
            MAX(IF(DAY(tgl_presensi) = 3,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_3,
            MAX(IF(DAY(tgl_presensi) = 4,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_4,
            MAX(IF(DAY(tgl_presensi) = 5,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_5,
            MAX(IF(DAY(tgl_presensi) = 6,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_6,
            MAX(IF(DAY(tgl_presensi) = 7,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_7,
            MAX(IF(DAY(tgl_presensi) = 8,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_8,
            MAX(IF(DAY(tgl_presensi) = 9,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_9,
            MAX(IF(DAY(tgl_presensi) = 10,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_10,
            MAX(IF(DAY(tgl_presensi) = 11,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_11,
            MAX(IF(DAY(tgl_presensi) = 12,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_12,
            MAX(IF(DAY(tgl_presensi) = 13,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_13,
            MAX(IF(DAY(tgl_presensi) = 14,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_14,
            MAX(IF(DAY(tgl_presensi) = 15,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_15,
            MAX(IF(DAY(tgl_presensi) = 16,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_16,
            MAX(IF(DAY(tgl_presensi) = 17,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_17,
            MAX(IF(DAY(tgl_presensi) = 18,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_18,
            MAX(IF(DAY(tgl_presensi) = 19,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_19,
            MAX(IF(DAY(tgl_presensi) = 20,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_20,
            MAX(IF(DAY(tgl_presensi) = 21,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_21,
            MAX(IF(DAY(tgl_presensi) = 22,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_22,
            MAX(IF(DAY(tgl_presensi) = 23,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_23,
            MAX(IF(DAY(tgl_presensi) = 24,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_24,
            MAX(IF(DAY(tgl_presensi) = 25,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_25,
            MAX(IF(DAY(tgl_presensi) = 26,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_26,
            MAX(IF(DAY(tgl_presensi) = 27,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_27,
            MAX(IF(DAY(tgl_presensi) = 28,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_28,
            MAX(IF(DAY(tgl_presensi) = 29,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_29,
            MAX(IF(DAY(tgl_presensi) = 30,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_30,
            MAX(IF(DAY(tgl_presensi) = 31,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_31')
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->whereRaw('MONTH(tgl_presensi) ="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi) ="'.$tahun.'"')
        ->groupByRaw('presensi.nik,nama_lengkap')
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
        
        if(isset($_POST['exportexcel'])){
            $time = date('H:i:s');
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Rekap Presensi ".$bln[$bulan]." ".$tahun." ".$time.".xls");
        }

        return view('presensi.cetakrekap',compact ('rekap','bln','bulan','tahun'));
    }

    public function izinsakit(Request $request){
            $query = Pengajuanizin::query();
            $query->select('id','pengajuan_izin.nik','tgl_izin','status','keterangan','status_approved','nama_lengkap','pangkat');
            $query->join('karyawan','karyawan.nik','=','pengajuan_izin.nik');
            if(!empty($request->dari) && !empty($request->sampai)){
                $query->whereBetween('tgl_izin', [$request->dari, $request->sampai]);
            }
            if(!empty($request->nik)){
                $query->where('pengajuan_izin.nik', $request->nik);
            }
            if(!empty($request->nama_lengkap)){
                $query->where('nama_lengkap', 'like', '%'.$request->nama_lengkap.'%');
            }
            if($request->status_approved != ""){
                $query->where('status_approved', $request->status_approved);
            }
            $query->orderBy('tgl_izin','desc');
            $izinsakit = $query->paginate(5);
            $izinsakit->appends($request->all());
            return view('presensi.izinsakit',compact ('izinsakit'));
    }

    public function approveizin(Request $request){
        $id_izinsakit_form = $request->id_izinsakit_form;
        $status_approved = $request->status_approved;
        $update = DB::table('pengajuan_izin')->where('id', $id_izinsakit_form)->update(['status_approved' => $status_approved]);
        if($update){
            return redirect('/presensi/izinsakit')->with(['success' => 'Data Berhasil di Update']);
         }else{
             return redirect('/presensi/izinsakit')->with(['error' => 'Data Gagal di Update']);
         }
    }

    public function batalkanizin($id){
        $update = DB::table('pengajuan_izin')->where('id', $id)->update(['status_approved' => 0]);
        if($update){
            return redirect('/presensi/izinsakit')->with(['success' => 'Data Berhasil di Update']);
         }else{
             return redirect('/presensi/izinsakit')->with(['error' => 'Data Gagal di Update']);
         }
    }

    public function cekizin(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $cek = DB::table('pengajuan_izin')->where('nik', $nik)->where('tgl_izin', $tgl_izin)->count();
        return $cek;
    }

}
