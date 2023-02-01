<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CekLoginController;
use App\Http\Controllers\IndexController;

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

Route::get('/', function () {
    return view('beranda');
});
Route::post('/ceklogin', [CekLoginController::class, 'cekLogin' ]);
Route::get('/index', [IndexController::class, 'getIndex' ]);
Route::post('/data', [IndexController::class, 'getDataMaster' ]);
Route::post('/siswa', [IndexController::class, 'getDataSiswa' ]);
Route::post('/kelas', [IndexController::class, 'getDataKelas' ]);
Route::post('/dataubah', [IndexController::class, 'getDataUbah' ]);
Route::post('/datahapus', [IndexController::class, 'getDataHapus' ]);
Route::post('/laporan', [IndexController::class, 'getDataLaporan' ]);
Route::post('/users', [IndexController::class, 'getDataUsers' ]);
Route::post('/simpan', [IndexController::class, 'getDataSimpan' ]);
Route::get('/keluar', [CekLoginController::class, 'keluarAplikasi' ]);