<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IzinAbsenController extends Controller
{
    public function create()
    {
        return view('izin.create');
    }

    public function store(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $status = "i";
        $keterangan = $request->keterangan;

        $bulan = date('m', strtotime($tgl_izin_dari));
        $tahun = date('Y', strtotime($tgl_izin_dari));
        $thn = substr($tahun, 2, 2,);

        $lastizin = DB::table('pengajuan_izin')
        ->whereRaw('MONTH(tgl_izin_dari) ="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_izin_dari) ="'.$tahun.'"')
        ->orderBy('kode_izin', 'desc')
        ->first();
        $lastkodeizin = $lastizin != null ? $lastizin->kode_izin : "";
        $format = "IZ".$bulan.$thn;
        $nomor_baru = intval(substr($lastkodeizin, strlen($format))) + 1;
        $nomor_baru_plus_nol = str_pad($nomor_baru, 3, "0", STR_PAD_LEFT);
        $kode = $format . $nomor_baru_plus_nol;
        $kode_izin = $kode;
        $data = array(
            'kode_izin' => $kode_izin,
            'nik' => $nik,
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'status' => $status,
            'keterangan' => $keterangan,
        );

        $cekpresensi = DB::table('presensi')
        ->whereBetween('tgl_presensi', [$tgl_izin_dari, $tgl_izin_sampai]);

        $cekpengajuan = DB::table('pengajuan_izin')
        ->whereRaw('"' . $tgl_izin_dari.'" BETWEEN tgl_izin_dari AND tgl_izin_sampai');

        $datapresensi = $cekpresensi->get();
        if($cekpresensi->count() > 0){
            $blacklist = "";
            foreach($datapresensi as $d){
                $blacklist .= date('d-m-Y',strtotime( $d->tgl_presensi)).", ";
            }
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan, Tanggal ' .$blacklist. 'Sudah Ada']);
        }else if($cekpengajuan->count() > 0){
            $blacklist = "";
            foreach($cekpengajuan->get() as $d){
                $blacklist .= date('d-m-Y',strtotime( $d->tgl_izin_dari)).", ";
            }
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan, Tanggal ' .$blacklist. 'Sudah Ada']);
        }
        else{
            $simpan = DB::table('pengajuan_izin')->insert($data);
            if($simpan){
                return redirect('/presensi/izin')->with(['success' => 'Data Berhasil di Simpan']);
             }else{
                 return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan']);
             }
        }
    }

    public function createsakit()
    {
        return view('izin.createsakit');
    }

    public function storesakit(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $status = "s";
        $keterangan = $request->keterangan;

        $bulan = date('m', strtotime($tgl_izin_dari));
        $tahun = date('Y', strtotime($tgl_izin_dari));
        $thn = substr($tahun, 2, 2,);

        $lastizin = DB::table('pengajuan_izin')
        ->whereRaw('MONTH(tgl_izin_dari) ="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_izin_dari) ="'.$tahun.'"')
        ->orderBy('kode_izin', 'desc')
        ->first();
        $lastkodeizin = $lastizin != null ? $lastizin->kode_izin : "";
        $format = "IZ".$bulan.$thn;
        $nomor_baru = intval(substr($lastkodeizin, strlen($format))) + 1;
        $nomor_baru_plus_nol = str_pad($nomor_baru, 3, "0", STR_PAD_LEFT);
        $kode = $format . $nomor_baru_plus_nol;
        $kode_izin = $kode;
        if ($request->hasFile('doc_sid')) {
            $doc_sid = $kode_izin . "." . $request->file('doc_sid')->getClientOriginalExtension();
        }else{
            $doc_sid = null;
        }
        $data = array(
            'kode_izin' => $kode_izin,
            'nik' => $nik,
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'status' => $status,
            'keterangan' => $keterangan,
            'doc_sid' => $doc_sid,
        );

        $cekpresensi = DB::table('presensi')
        ->whereBetween('tgl_presensi', [$tgl_izin_dari, $tgl_izin_sampai]);

        $cekpengajuan = DB::table('pengajuan_izin')
        ->whereRaw('"' . $tgl_izin_dari.'" BETWEEN tgl_izin_dari AND tgl_izin_sampai');

        $datapresensi = $cekpresensi->get();
        if($cekpresensi->count() > 0){
            $blacklist = "";
            foreach($datapresensi as $d){
                $blacklist .= date('d-m-Y',strtotime( $d->tgl_presensi)).", ";
            }
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan, Tanggal ' .$blacklist. 'Sudah Ada']);
        }else if($cekpengajuan->count() > 0){
            $blacklist = "";
            foreach($cekpengajuan->get() as $d){
                $blacklist .= date('d-m-Y',strtotime( $d->tgl_izin_dari)).", ";
            }
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan, Tanggal ' .$blacklist. 'Sudah Ada']);
        }else{
            $simpan = DB::table('pengajuan_izin')->insert($data);
            if($simpan){
                return redirect('/presensi/izin')->with(['success' => 'Data Berhasil di Simpan']);
             }else{
                 return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan']);
             }
         }
    }

    public function createcuti()
    {
        $mastercuti = DB::table('master_cuti')->orderBy('kode_cuti')->get();
        return view('izin.createcuti', compact('mastercuti'));
    }

    public function storecuti(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $kode_cuti = $request->kode_cuti;
        $status = "c";
        $keterangan = $request->keterangan;

        $bulan = date('m', strtotime($tgl_izin_dari));
        $tahun = date('Y', strtotime($tgl_izin_dari));
        $thn = substr($tahun, 2, 2,);

        $lastizin = DB::table('pengajuan_izin')
        ->whereRaw('MONTH(tgl_izin_dari) ="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_izin_dari) ="'.$tahun.'"')
        ->orderBy('kode_izin', 'desc')
        ->first();
        $lastkodeizin = $lastizin != null ? $lastizin->kode_izin : "";
        $format = "IZ".$bulan.$thn;
        $nomor_baru = intval(substr($lastkodeizin, strlen($format))) + 1;
        $nomor_baru_plus_nol = str_pad($nomor_baru, 3, "0", STR_PAD_LEFT);
        $kode = $format . $nomor_baru_plus_nol;
        $kode_izin = $kode;

        function hitunghari($tanggal_mulai, $tanggal_akhir){
            $tanggal_1 = date_create($tanggal_mulai);
            $tanggal_2 = date_create($tanggal_akhir); // waktu sekarang
            $diff = date_diff( $tanggal_1, $tanggal_2);
    
            return $diff->days + 1;
        }   

        $jmlhari =  hitunghari($tgl_izin_dari, $tgl_izin_sampai);
        $cuti = DB::table('master_cuti')->where('kode_cuti', $kode_cuti)->first();
        $jml_cuti = $cuti->jml_hari;
        $cutidigunakan = DB::table('presensi')
        ->whereRaw('Year(tgl_presensi) = "'.$tahun.'"')
        ->where('status', 'c')
        ->where('nik', $nik)
        ->count();

        $sisacuti = $jml_cuti - $cutidigunakan;

        $data = array(
            'kode_izin' => $kode_izin,
            'nik' => $nik,
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'kode_cuti' => $kode_cuti,
            'status' => $status,
            'keterangan' => $keterangan,
        );
        
        $cekpresensi = DB::table('presensi')
        ->whereBetween('tgl_presensi', [$tgl_izin_dari, $tgl_izin_sampai]);

        $cekpengajuan = DB::table('pengajuan_izin')
        ->whereRaw('"' . $tgl_izin_dari.'" BETWEEN tgl_izin_dari AND tgl_izin_sampai');

        $datapresensi = $cekpresensi->get();

        if($jmlhari > $sisacuti){
            return redirect('/presensi/izin')->with(['error' => 'Sisa Cuti Melebihi Jumlah Cuti, Sisa Cuti Anda ' .$sisacuti. ' Hari']);
        }else if($cekpresensi->count() > 0){
            $blacklist = "";
            foreach($datapresensi as $d){
                $blacklist .= date('d-m-Y',strtotime( $d->tgl_presensi)).", ";
            }
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan, Tanggal ' .$blacklist. 'Sudah Ada']);
        }else if($cekpengajuan->count() > 0){
            $blacklist = "";
            foreach($cekpengajuan->get() as $d){
                $blacklist .= date('d-m-Y',strtotime( $d->tgl_izin_dari)).", ";
            }
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan, Tanggal ' .$blacklist. 'Sudah Ada']);
        }else{
            $simpan = DB::table('pengajuan_izin')->insert($data);
            if($simpan){
                return redirect('/presensi/izin')->with(['success' => 'Data Berhasil di Simpan']);
             }else{
                 return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan']);
             }
        }
    }

    public function edit($kode_izin)
    {
        $dataizin = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->first();
        return view('izin.edit', compact('dataizin'));
    }

    public function update($kode_izin, Request $request){

        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $keterangan = $request->keterangan;

        $data = array(
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'keterangan' => $keterangan,
        );
        $simpan = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->update($data);
        if($simpan){
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil di Simpan']);
         }else{
             return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan']);
         }
    }

    public function editsakit($kode_izin)
    {
        $dataizin = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->first();
        return view('izin.editsakit', compact('dataizin'));
    }

     public function updatesakit($kode_izin, Request $request){

        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $keterangan = $request->keterangan;

        if ($request->hasFile('doc_sid')) {
            $doc_sid = $kode_izin . "." . $request->file('doc_sid')->getClientOriginalExtension();
        }else{
            $doc_sid = null;
        }
        $data = array(
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'keterangan' => $keterangan,
            'doc_sid' => $doc_sid,
        );
        try {
            DB::table('pengajuan_izin')
            ->where('kode_izin', $kode_izin)
            ->update($data);
            if ($request->hasFile('doc_sid')) {
                $doc_sid = $kode_izin . "." . $request->file('doc_sid')->getClientOriginalExtension();
                $folderPath = "public/uploads/sid/";
                $request->file('doc_sid')->storeAs($folderPath, $doc_sid);
              }
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil di Simpan']);
        }catch(\Exception $e){
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan']);
        }
    }
    
    public function editcuti($kode_izin)
    {
        $mastercuti = DB::table('master_cuti')->orderBy('kode_cuti')->get();
        $dataizin = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->first();
        return view('izin.editcuti', compact('mastercuti','dataizin'));
    }

   
    public function updatecuti($kode_izin, Request $request){

        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $keterangan = $request->keterangan;
        $kode_cuti = $request->kode_cuti;

        $data = array(
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'kode_cuti' => $kode_cuti,
            'keterangan' => $keterangan,
        );
        $simpan = DB::table('pengajuan_izin')->where('kode_izin', $kode_izin)->update($data);
        if($simpan){
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil di Simpan']);
         }else{
             return redirect('/presensi/izin')->with(['error' => 'Data Gagal di Simpan']);
         }
    }

}
