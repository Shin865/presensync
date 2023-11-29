<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\BoardingController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\IzinAbsenController;
use App\Http\Controllers\PaketController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

Route::middleware(['guest:admin'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/control', function () {
        return view('auth.logincontrol');
    })->name('logincontrol');

    Route::post('/proseslogincontrol', [AuthController::class, 'proseslogincontrol']);
});

Route::middleware('auth:user')->group(function () {
    Route::get('control/dashboardcontrol', [DashboardController::class, 'dashboardcontrol']);
    Route::post('/control/{id_admin}/delete', [DashboardController::class, 'delete']);

    Route::get('/proseslogoutcontrol', [AuthController::class, 'proseslogoutcontrol']);
    Route::post('/dashboardcontrol/statusmitra', [DashboardController::class, 'statusmitra']);
    Route::get('/dashboardcontrol/paket', [PaketController::class, 'index']);
    Route::post('/paket/store', [PaketController::class, 'store']);
    Route::post('/paket/edit', [PaketController::class, 'edit']);
    Route::post('/paket/{kode_paket}/update', [PaketController::class, 'update']);
    Route::post('/paket/{kode_paket}/delete', [PaketController::class, 'delete']);

    Route::get('/dashboardcontrol/bukti', [PaketController::class, 'bukti']);
    Route::post('/control/{id_pembayaran}/deletebukti', [PaketController::class, 'deletebukti']);

});

Route::middleware('auth:karyawan')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    Route::get('/editprofile', [PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class, 'updateprofile']);

    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/gethistori', [PresensiController::class, 'gethistori']);

    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
    Route::post('/presensi/cekizin', [PresensiController::class, 'cekizin']);

    Route::get('/izinabsen', [IzinAbsenController::class, 'create']);
    Route::post('/izinabsen/store', [IzinAbsenController::class, 'store']);
    Route::get('/izinabsen/{kode_izin}/edit', [IzinAbsenController::class, 'edit']);
    Route::post('/izinabsen/{kode_izin}/update', [IzinAbsenController::class, 'update']);
    
    Route::get('/izinsakit', [IzinAbsenController::class, 'createsakit']);
    Route::post('/izinsakit/store', [IzinAbsenController::class, 'storesakit']);
    Route::get('/izinsakit/{kode_izin}/edit', [IzinAbsenController::class, 'editsakit']);
    Route::post('/izinsakit/{kode_izin}/update', [IzinAbsenController::class, 'updatesakit']);

    Route::get('/izincuti', [IzinAbsenController::class, 'createcuti']);
    Route::post('/izincuti/store', [IzinAbsenController::class, 'storecuti']);
    Route::get('/izincuti/{kode_izin}/edit', [IzinAbsenController::class, 'editcuti']);
    Route::post('/izincuti/{kode_izin}/update', [IzinAbsenController::class, 'updatecuti']);

    Route::get('/izin/{kode_izin}/showact', [PresensiController::class, 'showact']);
    Route::get('/izin/{kode_izin}/delete', [PresensiController::class, 'deleteizin']);
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
    Route::get('panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);

    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::post('/karyawan/store', [KaryawanController::class, 'store']);
    Route::post('/karyawan/edit', [KaryawanController::class, 'edit']);
    Route::post('/karyawan/{nik}/update', [KaryawanController::class, 'update']);
    Route::post('/karyawan/{nik}/delete', [KaryawanController::class, 'delete']);
    Route::get('/karyawan/{nik}/resetpassword', [KaryawanController::class, 'resetpassword']);

    Route::get('/jabatan', [JabatanController::class, 'index']);
    Route::post('/jabatan/store', [JabatanController::class, 'store']);
    Route::post('/jabatan/edit', [JabatanController::class, 'edit']);
    Route::post('/jabatan/{kode_jab}/update', [JabatanController::class, 'update']);
    Route::post('/jabatan/{kode_jab}/delete', [JabatanController::class, 'delete']);

    Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring']);
    Route::post('/getpresensi', [PresensiController::class, 'getpresensi']);
    Route::post('/showmap',[PresensiController::class,'showmap']);
    Route::get('/presensi/laporan', [PresensiController::class, 'laporan']);
    Route::post('/presensi/cetaklaporan', [PresensiController::class, 'cetaklaporan']);
    Route::get('/presensi/rekap', [PresensiController::class, 'rekap']);
    Route::post('/presensi/cetakrekap', [PresensiController::class, 'cetakrekap']);
    Route::get('/presensi/izinsakit', [PresensiController::class, 'izinsakit']);
    Route::post('/presensi/approveizin', [PresensiController::class, 'approveizin']);
    Route::get('/presensi/{kode_izin}/batalkanizin', [PresensiController::class, 'batalkanizin']);
    
    Route::get('/konfigurasi/lokasikantor', [KonfigurasiController::class, 'lokasikantor']);
    Route::post('/konfigurasi/updatelokkantor', [KonfigurasiController::class, 'updatelokkantor']);

    Route::get('/cuti', [CutiController::class, 'index']);
    Route::post('/cuti/store', [CutiController::class, 'store']);
    Route::post('/cuti/edit', [CutiController::class, 'edit']);
    Route::post('/cuti/{kode_cuti}/update', [CutiController::class, 'update']);
    Route::post('/cuti/{kode_cuti}/delete', [CutiController::class, 'delete']);
});

    Route::get('/boarding', [BoardingController::class, 'boarding']);
    Route::get('/boarding/akun', [BoardingController::class, 'akun']);
    Route::post('/boarding/register', [BoardingController::class, 'register']);
    Route::get('/boarding/pembayaran1', [BoardingController::class, 'pembayaran1']);
    Route::get('/boarding/pembayaran2', [BoardingController::class, 'pembayaran2']);
    Route::post('/boarding/pembayaranpaket1', [BoardingController::class, 'pembayaranpaket1']);
    Route::post('/boarding/pembayaranpaket2', [BoardingController::class, 'pembayaranpaket2']);