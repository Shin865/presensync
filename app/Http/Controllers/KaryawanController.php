<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
       
        $idAdmin = $request->session()->get('id_admin');
        $query = Karyawan::query();
        $query->select('karyawan.*', 'nama_jab');
        $query->join('jabatan', 'karyawan.kode_jab', '=', 'jabatan.kode_jab');
        $query->orderBy('nama_lengkap');
        $query->where('karyawan.id_admin', $idAdmin);
        if(!empty($request->nama_karyawan)){
            $query->where('nama_lengkap','like','%'.$request->nama_karyawan.'%');
        }
        if(!empty($request->kode_jab)){
            $query->where('karyawan.kode_jab',$request->kode_jab);
        }
        $karyawan = $query->paginate(5);

        $jabatan = DB::table('jabatan')->get();

        return view('karyawan.index',compact('karyawan','jabatan'));
    }

    public function store(Request $request)
    {
        $idAdmin =$request->session()->get('id_admin');
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $pangkat = $request->pangkat;
        $no_hp = $request->no_hp;
        $kode_jab = $request->kode_jab;
        $password = Hash::make(12345);
        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
         }else{
            $foto = null;
         }
         try{
            $data = array(
                'nik' =>$nik,
                'id_admin' => $idAdmin,
                'nama_lengkap' =>$nama_lengkap,
                'pangkat' => $pangkat,
                'no_hp' => $no_hp,
                'kode_jab' => $kode_jab,
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
            if($e->getCode() == 23000){
                return Redirect::back()->with(['error' => 'NIK Sudah Terdaftar']);
            }
            return Redirect::back()->with(['error' => 'Data Gagal di Simpan']);
        }
    }

    public function edit(Request $request){
        $idAdmin =$request->session()->get('id_admin');
        $nik = $request->nik;
        $jabatan = DB::table('jabatan')->get();
        $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
        return view('karyawan.edit',compact('jabatan','karyawan'));
    }

    public function update(Request $request){
        $idAdmin =$request->session()->get('id_admin');
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $pangkat = $request->pangkat;
        $no_hp = $request->no_hp;
        $kode_jab = $request->kode_jab;
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
                'id_admin' => $idAdmin,
                'pangkat' => $pangkat,
                'no_hp' => $no_hp,
                'kode_jab' => $kode_jab,
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

    public function resetpassword($nik){
        $nik = Crypt::decrypt($nik);
        $password = Hash::make(12345);
        $reset = DB::table('karyawan')
        ->where('nik',$nik)
        ->update([
            'password' => $password
        ]);
        if($reset){
            return Redirect::back()->with(['success' => 'Password Berhasil di Reset']);
        }else{
            return Redirect::back()->with(['error' => 'Password Gagal di Reset']);
        }
    }

}