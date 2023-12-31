<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class BoardingController extends Controller
{
    public function boarding()
    {
        return view('boarding.boarding');
    }

    public function akun()
    {
        $masterpaket = DB::table('master_paket')->get();
        return view('boarding.akun',compact('masterpaket'));
    }

    public function register(Request $request){
        $nama_admin = $request->nama_admin;
        $email = $request->email;
        $password = Hash::make($request->password);
        $kode_paket = $request->kode_paket;
        $tgl_daftar = date('Y-m-d');
        if($kode_paket == "P01"){
            $tgl_expired = date('Y-m-d', strtotime('+3 month', strtotime($tgl_daftar)));

            $data = array(
                'nama_admin' =>$nama_admin,
                'email' =>$email,
                'password' =>$password,
                'kode_paket' =>$kode_paket,
                'tgl_daftar' =>$tgl_daftar,
                'tgl_expired' =>$tgl_expired,
                
            );
            $simpan = DB::table('admins')->insert($data);
            if($simpan){
                return redirect('boarding/pembayaran1')->with('success','Silahkan lakukan pembayaran untuk pengaktifan akun');
            }else{
                return Redirect::back()->with('error','Data gagal disimpan');
            }
        }elseif($kode_paket == "P02"){
            $tgl_expired = date('Y-m-d', strtotime('+6 month', strtotime($tgl_daftar)));
        }
        $data = array(
            'nama_admin' =>$nama_admin,
            'email' =>$email,
            'password' =>$password,
            'kode_paket' =>$kode_paket,
            'tgl_daftar' =>$tgl_daftar,
            'tgl_expired' =>$tgl_expired,
            
        );
        $simpan = DB::table('admins')->insert($data);
        if($simpan){
            return redirect('boarding/pembayaran2')->with('success','Silahkan lakukan pembayaran untuk pengaktifan akun');
        }else{
            return Redirect::back()->with('error','Data gagal disimpan');
        }
    }

    public function pembayaran1(){
        $masterpaket = DB::table('master_paket')->get();
        return view('boarding.pembayaran1',compact('masterpaket'));
    }

    public function pembayaran2(){
        $masterpaket = DB::table('master_paket')->get();
        return view('boarding.pembayaran',compact('masterpaket'));
    }

    public function pembayaranpaket1(Request $request){
        $nama_mitra = $request->nama_mitra;
        $email = $request->email;
        $bukti = $nama_mitra.".".$request->file('bukti')->getClientOriginalExtension();
        $paket = '3 Bulan';
        $tgl_upload = date('Y-m-d');
         try{
            $data = array(
                'nama_mitra' =>$nama_mitra,
                'email' =>$email,
                'bukti' =>$bukti,
                'paket' =>$paket,
                'tgl_upload' =>$tgl_upload,
            );
            $simpan = DB::table('pembayaran')->insert($data);
            if($simpan){
               if($request->hasFile('bukti')){
                  $folderPath = "public/uploads/bukti/";
                  $request->file('bukti')->storeAs($folderPath, $bukti);
               }
               return redirect('boarding/akun')->with('success','Pembayaran sukses, silahkan tunggu konfirmasi dari admin');
            }    
        }catch(\Exception $e){
            return Redirect::back()->with(['error' => 'Data Gagal di Simpan']);
        }
    }
    public function pembayaranpaket2(Request $request){
        $nama_mitra = $request->nama_mitra;
        $email = $request->email;
        $bukti = $nama_mitra.".".$request->file('bukti')->getClientOriginalExtension();
        $paket = '6 Bulan';
        $tgl_upload = date('Y-m-d');
        try{
           $data = array(
               'nama_mitra' =>$nama_mitra,
               'email' =>$email,
               'bukti' =>$bukti,
               'paket' =>$paket,
               'tgl_upload' =>$tgl_upload,
           );
            $simpan = DB::table('pembayaran')->insert($data);
            if($simpan){
               if($request->hasFile('bukti')){
                  $folderPath = "public/uploads/bukti/";
                  $request->file('bukti')->storeAs($folderPath, $bukti);
               }
               return redirect('boarding/akun')->with('success','Pembayaran sukses, silahkan tunggu konfirmasi dari admin');
            }    
        }catch(\Exception $e){
            return Redirect::back()->with(['error' => 'Data Gagal di Simpan']);
        }
    }
}
