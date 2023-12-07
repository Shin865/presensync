<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $idAdmin = $request->session()->get('id_admin');
        $nama_jab = $request->nama_jab;
        $query = Jabatan::query();
        $query->where('jabatan.id_admin', $idAdmin);
        $query->leftJoin('admins', 'jabatan.id_admin', '=', 'admins.id_admin');
        $query->orderBy('nama_jab');
        $query->select('*');
        if(!empty($nama_jab)){
            $query->where('nama_jab','like','%'.$request->nama_jab.'%');
        }
        $jabatan = $query->get();
        //$jabatan = DB::table('jabatan')->orderBy('kode_jab')->get();
        return view('jabatan.index',compact('jabatan'));
    }

    public function store(Request $request){
        $idAdmin = $request->session()->get('id_admin');
        $kode_jab = $request->kode_jab;
        $nama_jab = $request->nama_jab;
        $data = array(
            'id_admin' =>$idAdmin,
            'kode_jab' =>$kode_jab,
            'nama_jab' =>$nama_jab
        );
        $cek = DB::table('jabatan')->where('kode_jab',$kode_jab)->count();
        if($cek>0){
            return Redirect::back()->with('error','Kode jabatan '. $kode_jab. ' sudah ada');
        }
        $simpan = DB::table('jabatan')->insert($data);
        if($simpan){
            return Redirect::back()->with('success','Data berhasil disimpan');
        }else{
            return Redirect::back()->with('error','Data gagal disimpan');
        }
    }

    public function edit(Request $request){
        $kode_jab = $request->kode_jab;
        $jabatan = DB::table('jabatan')->where('kode_jab',$kode_jab)->first();
        return view('jabatan.edit',compact('jabatan'));
    }

    public function update($kode_jab,Request $request){
        $nama_jab = $request->nama_jab;
        $data = array(
            'nama_jab' =>$nama_jab
        );
        $update = DB::table('jabatan')->where('kode_jab',$kode_jab)->update($data);
        if($update){
            return Redirect::back()->with('success','Data berhasil diupdate');
        }else{
            return Redirect::back()->with('error','Data gagal diupdate');
        }
    }

    public function delete($kode_jab){
        $delete = DB::table('jabatan')->where('kode_jab',$kode_jab)->delete();
        if($delete){
            return Redirect::back()->with('success','Data berhasil dihapus');
        }else{
            return Redirect::back()->with('error','Data gagal dihapus');
        }
    }

}