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
        $masterpaket = DB::table('master_paket')->orderBy('kode_paket')->get();
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
            return Redirect::back()->with('success','Data berhasil disimpan');
        }else{
            return Redirect::back()->with('error','Data gagal disimpan');
        }
    }
}
