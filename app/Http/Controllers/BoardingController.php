<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BoardingController extends Controller
{
    public function boarding()
    {
        return view('boarding.boarding');
    }

    public function akun()
    {
        return view('boarding.akun');
    }

    public function register(Request $request){
        $nama_admin = $request->nama_admin;
        $email = $request->email;
        $password = $request->password;
        $paket = $request->paket;
        $data = array(
            'nama_admin' =>$nama_admin,
            'email' =>$email,
            'password' =>$password,
            'paket' =>$paket
            
        );
        $simpan = DB::table('admins')->insert($data);
        if($simpan){
            return Redirect::back()->with('success','Data berhasil disimpan');
        }else{
            return Redirect::back()->with('error','Data gagal disimpan');
        }
    }
}
