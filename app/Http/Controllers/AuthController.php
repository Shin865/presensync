<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    
            // Pengecekan status dan tanggal expired
            if ($admin->status == 'N') {
               Auth::guard('admin')->logout(); // Logout jika status 'N' atau sudah expired
                return redirect('/panel')->with(['warning' => 'Akun dinonaktifkan atau sudah expired.']);
            }

            if (Carbon::now()->gt($admin->tgl_expired)) {
                DB::table('admins')
                ->where('id_admin', $admin->id_admin)
                ->update([
                    'status' => 'N'
                ]);
                Auth::guard('admin')->logout(); // Logout jika status 'N' atau sudah expired
                return redirect('/panel')->with(['warning' => 'Akun dinonaktifkan atau sudah expired.']);
            }
    
            $idAdmin = $admin->id_admin; // Sesuaikan dengan kolom ID pada model admin
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
