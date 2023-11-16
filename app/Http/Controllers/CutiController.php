<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = DB::table('master_cuti')->orderBy('kode_cuti')->get();
        return view('cuti.index', compact('cuti'));
    }

    public function store(Request $request)
    {
        $kode_cuti = $request->kode_cuti;
        $nama_cuti = $request->nama_cuti;
        $jml_hari = $request->jml_hari;

        $cekcuti = DB::table('master_cuti')->where('kode_cuti', $kode_cuti)->count();
        if ($cekcuti > 0) {
            return Redirect::back()->with('error','Kode Cuti '. $kode_cuti. ' sudah ada');
        }
        try {
            DB::table('master_cuti')->insert([
                'kode_cuti' => $kode_cuti,
                'nama_cuti' => $nama_cuti,
                'jml_hari' => $jml_hari
            ]);
            return Redirect::back()->with('success','Data berhasil disimpan');
        } catch (\Throwable $th) {
            return Redirect::back()->with('error','Data gagal disimpan');
        }
    }

    public function edit(Request $request)
    {
        $kode_cuti = $request->kode_cuti;
        $cuti = DB::table('master_cuti')->where('kode_cuti', $kode_cuti)->first();
        return view('cuti.edit', compact('cuti'));
    }

    public function update(Request $request, $kode_cuti){
        $nama_cuti = $request->nama_cuti;
        $jml_hari = $request->jml_hari;
        $data = array(
            'nama_cuti' =>$nama_cuti,
            'jml_hari' =>$jml_hari
        );
        $update = DB::table('master_cuti')->where('kode_cuti',$kode_cuti)->update($data);
        if($update){
            return Redirect::back()->with('success','Data berhasil diupdate');
        }else{
            return Redirect::back()->with('error','Data gagal diupdate');
        }
    }

    public function delete($kode_cuti){
        $delete = DB::table('master_cuti')->where('kode_cuti',$kode_cuti)->delete();
        if($delete){
            return Redirect::back()->with('success','Data berhasil dihapus');
        }else{
            return Redirect::back()->with('error','Data gagal dihapus');
        }
    }
}
