<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        if (Auth::guard('karyawan')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'NIK atau Password salah']);
        }   
    }

    public function prosesloginadmin(Request $request)
{
    $credentials = ['email' => $request->email, 'password' => $request->password];
   
    if (Auth::guard('admin')->attempt($credentials)) {
        $admin = Auth::guard('admin')->user();
        
        if ($admin->status == 'N') {
            Auth::guard('admin')->logout();
            return redirect('/panel')->with(['warning' => 'Akun dinonaktifkan.']);
        }

        $idAdmin = $admin->id_admin;
        $request->session()->put('id_admin', $idAdmin);

        return redirect('/panel/dashboardadmin');
    } else {
        return redirect('/panel')->with(['warning' => 'Email atau Password salah']);
    }
}

    public function proseslogincontrol(Request $request)
    {
        if (Auth::guard('user')->attempt(['name' => $request->name, 'password' => $request->password])) {
            return redirect('/control/dashboardcontrol');
        } else {
            return redirect('/control')->with(['warning' => 'Nama atau Password salah']);
        }   
    }

    public function proseslogout()
    {
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    public function proseslogoutadmin(){
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect('/panel');
        }
    }

    public function proseslogoutcontrol()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/control');
        }
    }

}
