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
        $nik = Auth::guard('karyawan')->user()->nik;
    
        // Ambil karyawan dari model Karyawan
        $karyawan = Karyawan::where('nik', $nik)->first();
    
        // Pastikan karyawan ditemukan
        if ($karyawan) {
            // Gunakan relasi untuk mendapatkan admin terkait
            $lok_kantor = $karyawan->admin;
    
            // Check presensi dan tgl_presensi seperti sebelumnya
            $harini = date('Y-m-d');
            $cek = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $harini)->count();
    
            return view('presensi.create', compact('cek', 'lok_kantor'));
        } else {
            // Handle jika karyawan tidak ditemukan
            return redirect()->back()->with('error', 'Karyawan tidak ditemukan');
        }
    }

    public function store(Request $request)
    { 
       $nik = Auth::guard('karyawan')->user()->nik;
       $tgl_presensi = date('Y-m-d');
       $jam = date('H:i:s');
       $admin = DB::table('admins')->leftJoin('karyawan','admins.id_admin','=','karyawan.id_admin')->where('nik', $nik)->first()->id_admin;
       //lokasi Kantor
       $lok_kantor = DB::table('admins')->where('id_admin',$admin)->first();
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

       $presensi= DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $tgl_presensi);
       $cek = $presensi->count();
       $datapresensi = $presensi->first(); 
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
            if(!empty($datapresensi->jam_out)){
                echo "error|Maaf Anda Sudah Melakukan Presensi Pulang";
            }
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
                 echo "error|Maaf Presensi gagal dilakukan|out";
             }
       }else{
        $data = array(
            'nik' => $nik,
            'tgl_presensi' => $tgl_presensi,
            'jam_in' => $jam,
            'foto_in' => $filename,
            'lokasi_in' => $lokasi,
            'status' => 'h',
        );
        $simpan = DB::table('presensi')->insert($data);
           if($simpan){
               echo "success|Terimakasih, Anda telah melakukan presensi masuk|in";
               Storage::put($file, $image_base64);
            }else{
                echo "error|Maaf Presensi gagal dilakukan|in";
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
         $request->validate([
             'foto' => 'image|mimes:jpeg,png,jpg|max:2000',
         ]);
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
        ->orderBy('tgl_presensi','DESC')
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
        return view('presensi.histori',compact ('historibulan','bln'));
     }

     public function gethistori(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;
        $histori = DB::table('presensi')
        ->select('presensi.*', 'keterangan','doc_sid','master_cuti.*')
        ->leftJoin('pengajuan_izin', 'presensi.kode_izin', '=', 'pengajuan_izin.kode_izin')
        ->leftJoin('master_cuti', 'pengajuan_izin.kode_cuti', '=', 'master_cuti.kode_cuti')
        ->where('presensi.nik', $nik)
        ->whereRaw('MONTH(tgl_presensi) ="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi) ="'.$tahun.'"')
        ->orderBy('tgl_presensi','desc')
        ->get();

        return view('presensi.gethistori',compact ('histori'));
     }

    public function izin(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        if(!empty($request->bulan) && !empty($request->tahun)){
            $dataizin = DB::table('pengajuan_izin')
            ->leftJoin('master_cuti','pengajuan_izin.kode_cuti','=','master_cuti.kode_cuti')
            ->where('nik',$nik)
            ->orderBy('tgl_izin_dari','desc')
            ->whereRaw('MONTH(tgl_izin_dari) ="'.$request->bulan.'"')
            ->whereRaw('YEAR(tgl_izin_dari) ="'.$request->tahun.'"')
            ->get();
        }else{
            $dataizin = DB::table('pengajuan_izin')
            ->leftJoin('master_cuti','pengajuan_izin.kode_cuti','=','master_cuti.kode_cuti')
            ->where('nik',$nik)
            ->orderBy('tgl_izin_dari','desc')
            ->limit(5)
            ->get();
        }
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
        return view('presensi.izin',compact ('dataizin','bln'));
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
        $adminId = session()->get('id_admin');
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')->select('presensi.*','nama_lengkap','nama_jab','keterangan')
        ->leftJoin('pengajuan_izin','presensi.kode_izin','=','pengajuan_izin.kode_izin')
        ->join('karyawan','karyawan.nik','=','presensi.nik')
        ->leftJoin('admins','karyawan.id_admin','=','admins.id_admin')
        ->join('jabatan','jabatan.kode_jab','=','karyawan.kode_jab')
        ->where('karyawan.id_admin', $adminId)
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
    $adminId = Auth::guard('admin')->user()->id_admin;

    $karyawan = DB::table('karyawan')->where('id_admin', $adminId)->orderBy('nama_lengkap')->get();

    return view('presensi.laporan', compact('bln', 'karyawan'));
    }

    public function cetaklaporan(Request $request){
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $karyawan = DB::table('karyawan')->where('nik',$nik)
        ->join('jabatan','jabatan.kode_jab','=','karyawan.kode_jab')
        ->first();
        $admin = DB::table('admins')->where('id_admin',$karyawan->id_admin)->first();
        $presensi = DB::table('presensi')
        ->select('presensi.*','keterangan')
        ->leftJoin('pengajuan_izin','presensi.kode_izin','=','pengajuan_izin.kode_izin')
        ->where('presensi.nik', $nik)
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
        }

        return view('presensi.cetaklaporan',compact ('presensi','bln','karyawan','bulan','tahun','admin'));
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
        $adminId = Auth::guard('admin')->user()->id_admin;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $admin = DB::table('admins')->where('id_admin',$adminId)->first();
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
        $dari = $tahun."-".$bulan."-01";
        $sampai = date('Y-m-t', strtotime($dari));
        $select_date = "";
        $field_date = "";
        $i = 1;

        while(strtotime($dari) <= strtotime($sampai))
        {
            $rangetanggal[] = $dari;

            $select_date .= "MAX(IF(tgl_presensi = '$dari',
            CONCAT(
                IFNULL(jam_in, 'NA'),'|',
                IFNULL(jam_out, 'NA'),'|',
                IFNULL(presensi.status,'NA'),'|',
                IFNULL(presensi.kode_izin,'NA'),'|'
                ),NULL)) as tgl_". $i .",";

            $field_date .= "tgl_". $i .",";
            $i++;
            $dari = date('Y-m-d', strtotime('+1 days', strtotime($dari)));
        }

        $jmlhari = count($rangetanggal);
        $lastrange = $jmlhari - 1;
        $sampai = $rangetanggal[$lastrange];
        if($jmlhari == 30){
            array_push($rangetanggal, NULL);
        }else if($jmlhari == 29){
            array_push($rangetanggal, NULL, NULL);
        }else if($jmlhari == 28){
            array_push($rangetanggal, NULL, NULL, NULL);
        }
        $query = Karyawan::query()
        ->where('id_admin', $adminId);
        $query->selectRaw(
            "$field_date karyawan.nik,nama_lengkap,pangkat"
        );
        $query->leftJoin(
            DB::raw("(
                SELECT
                $select_date 
                presensi.nik
                FROM presensi
                WHERE tgl_presensi BETWEEN '$rangetanggal[0]' AND '$sampai'
                GROUP BY nik
            ) presensi"),
            function($join){
                $join->on('karyawan.nik', '=', 'presensi.nik');
            }
        );

            $query->orderBy('nama_lengkap');
            $rekap = $query->get(); 

        if(isset($_POST['exportexcel'])){
            $time = date('H:i:s');
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Rekap Presensi ".$bln[$bulan]." ".$tahun." ".$time.".xls");
        }

        return view('presensi.cetakrekap',compact ('rekap','bln','bulan','tahun','jmlhari','rangetanggal','admin'));
    }

    public function izinsakit(Request $request){
            $adminId = Auth::guard('admin')->user()->id_admin;
            $query = Pengajuanizin::query();
            $query->select('kode_izin','pengajuan_izin.nik','tgl_izin_dari','tgl_izin_sampai','status','keterangan','status_approved','nama_lengkap','pangkat');
            $query->join('karyawan','karyawan.nik','=','pengajuan_izin.nik');
            $query->where('karyawan.id_admin', $adminId);
            if(!empty($request->dari) && !empty($request->sampai)){
                $query->whereBetween('tgl_izin_dari', [$request->dari, $request->sampai]);
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
            $query->orderBy('tgl_izin_dari','desc');
            $izinsakit = $query->paginate(10);
            $izinsakit->appends($request->all());
            return view('presensi.izinsakit',compact ('izinsakit'));
    }

    public function approveizin(Request $request){
        $kode_izin = $request->kode_izin_form;
        $status_approved = $request->status_approved;
        $dataizin = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->first();
        $nik = $dataizin->nik;
        $tgl_dari = $dataizin->tgl_izin_dari;
        $tgl_sampai = $dataizin->tgl_izin_sampai;
        $status = $dataizin->status;
        DB::beginTransaction();
        try{
            if($status_approved == 1){
             while(strtotime($tgl_dari) <= strtotime($tgl_sampai))
             {
                DB::table('presensi')->insert([
                    'nik' => $nik,
                    'tgl_presensi' => $tgl_dari,
                    'status' => $status,
                    'kode_izin' => $kode_izin,
                ]);
                $tgl_dari = date('Y-m-d', strtotime('+1 days', strtotime($tgl_dari)));
             }
            }
             DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->update(['status_approved' => $status_approved]);
             DB::commit();
             return Redirect::back()->with(['success' => 'Data Berhasil di Update']);
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::back()->with(['error' => 'Data Gagal di Update']);
        }
    }

    public function batalkanizin($kode_izin){

        DB::beginTransaction();
        try{
            DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)
            ->update(['status_approved' => 0]);
            DB::table('presensi')->where('kode_izin', $kode_izin)->delete();
            DB::commit();
            return Redirect::back()->with(['success' => 'Data Berhasil di Update']);
        }catch (\Exception $e) {
            DB::rollback();
            return Redirect::back()->with(['error' => 'Data Gagal di Update']);
        }
    }

    public function cekizin(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $cek = DB::table('pengajuan_izin')->where('nik', $nik)->where('tgl_izin', $tgl_izin)->count();
        return $cek;
    }

    public function showact($kode_izin){
        $dataizin = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->first();
        return view('presensi.showact', compact('dataizin'));
    }

    public function deleteizin($kode_izin){
        $cekdataizin = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->first();
        $doc_sid = $cekdataizin->doc_sid;
        $delete = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->delete();
        if($delete){
            if($doc_sid != null){
                Storage::delete('public/uploads/sid/'.$doc_sid);
            }
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil di Hapus']);
         }else{
             return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Hapus']);
         }
    }

}
