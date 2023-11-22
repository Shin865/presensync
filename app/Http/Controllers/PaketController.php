<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PaketController extends Controller
{
    public function index()
    {
        $paket = DB::table('master_paket')->orderBy('kode_paket')->get();
        return view('paket.index', compact('paket'));
    }

    public function store(Request $request)
    {
        $kode_paket = $request->kode_paket;
        $nama_paket = $request->nama_paket;
        $jml_hari = $request->jml_hari;

        $cekpaket = DB::table('master_paket')->where('kode_paket', $kode_paket)->count();
        if ($cekpaket > 0) {
            return Redirect::back()->with('error','Kode Paket '. $kode_paket. ' sudah ada');
        }
        try {
            DB::table('master_paket')->insert([
                'kode_paket' => $kode_paket,
                'nama_paket' => $nama_paket,
                'jml_hari' => $jml_hari
            ]);
            return Redirect::back()->with('success','Data berhasil disimpan');
        } catch (\Throwable $th) {
            return Redirect::back()->with('error','Data gagal disimpan');
        }
    }

    public function edit(Request $request)
    {
        $kode_paket = $request->kode_paket;
        $paket = DB::table('master_paket')->where('kode_paket', $kode_paket)->first();
        return view('paket.edit', compact('paket'));
    }

    public function update(Request $request, $kode_paket){
        $nama_paket = $request->nama_paket;
        $jml_hari = $request->jml_hari;
        $data = array(
            'nama_paket' =>$nama_paket,
            'jml_hari' =>$jml_hari
        );
        $update = DB::table('master_paket')->where('kode_paket',$kode_paket)->update($data);
        if($update){
            return Redirect::back()->with('success','Data berhasil diupdate');
        }else{
            return Redirect::back()->with('error','Data gagal diupdate');
        }
    }

    public function delete($kode_paket){
        $delete = DB::table('master_paket')->where('kode_paket',$kode_paket)->delete();
        if($delete){
            return Redirect::back()->with('success','Data berhasil dihapus');
        }else{
            return Redirect::back()->with('error','Data gagal dihapus');
        }
    }
}
