<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::query();
        $query->select('karyawan.*', 'nama_dept');
        $query->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept');
        $query->orderBy('nama_lengkap');
        if(!empty($request->nama_karyawan)){
            $query->where('nama_lengkap','like','%'.$request->nama_karyawan.'%');
        }
        if(!empty($request->kode_dept)){
            $query->where('karyawan.kode_dept',$request->kode_dept);
        }
        $karyawan = $query->paginate(5);

        $departemen = DB::table('departemen')->get();

        return view('karyawan.index',compact('karyawan','departemen'));
    }

    public function store(Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make(12345);
        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
         }else{
            $foto = null;
         }
         try{
            $data = array(
                'nik' =>$nik,
                'nama_lengkap' =>$nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dept' => $kode_dept,
                'foto' => $foto,
                'password' => $password
            );
            $simpan = DB::table('karyawan')->insert($data);
            if($simpan){
               if($request->hasFile('foto')){
                  $folderPath = "public/uploads/karyawan/";
                  $request->file('foto')->storeAs($folderPath, $foto);
               }
               return Redirect::back()->with(['success' => 'Data Berhasil di Simpan']);  
            }    
        }catch(\Exception $e){
            return Redirect::back()->with(['error' => 'Data Gagal di Simpan']);
        }
    }

    public function edit(Request $request){
        $nik = $request->nik;
        $departemen = DB::table('departemen')->get();
        $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
        return view('karyawan.edit',compact('departemen','karyawan'));
    }

    public function update(Request $request){

        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make(12345);
        $foto_lama = $request->foto_lama;
        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
         }else{
            $foto = $foto_lama;
         }
         try{
            $data = array(
                'nama_lengkap' =>$nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dept' => $kode_dept,
                'foto' => $foto,
                'password' => $password
            );
            $update = DB::table('karyawan')->where('nik',$nik)->update($data);
            if($update){
               if($request->hasFile('foto')){
                  $folderPath = "public/uploads/karyawan/";
                  $folderPathOld = "public/uploads/karyawan/".$foto_lama;
                  Storage::delete($folderPathOld);
                  $request->file('foto')->storeAs($folderPath, $foto);
               }
               return Redirect::back()->with(['success' => 'Data Berhasil Terupdate']);
            }    
        }catch(\Exception $e){
            return Redirect::back()->with(['error' => 'Data Gagal Terupdate']);
        }
    }

    public function delete($nik){
        $delete = DB::table('karyawan')->where('nik',$nik)->delete();
        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Terhapus']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Terhapus']);
        }
    }

}
