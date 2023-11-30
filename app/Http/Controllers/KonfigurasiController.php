<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KonfigurasiController extends Controller
{
    public function lokasikantor()
    {
        $id_admin = session('id_admin');

        // Gunakan id admin untuk mengambil data lokasi
        $lok_kantor = DB::table('admins')->where('id_admin', $id_admin)->first();
    
        return view('konfigurasi.lokasikantor', compact('lok_kantor'));
    }

    public function updatelokkantor(Request $request){
    $id_admin = session('id_admin');  
    $lokasi_kantor = $request->lokasi_kantor;
    $radius = $request->radius;

    $update = DB::table('admins')
        ->where('id_admin', $id_admin)
        ->update([
            'lokasi_kantor' => $lokasi_kantor,
            'radius' => $radius
        ]);

    if ($update) {
        return Redirect::back()->with('success', 'Lokasi kantor berhasil diubah');
    } else {
        return Redirect::back()->with('error', 'Lokasi kantor gagal diubah');
    }
    }
}