<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class CekLoginController extends Controller{
    public function cekLogin(Request $request){
        $username = $request->username;
        $password = $request->password;
		
        $users = DB::select('SELECT * FROM users WHERE username = ? AND password = ?', [$username,$password]);
		if(empty($users[0]->nama)){
			Session::put('nama', "");
			Session::put('username', "");
			Session::put('jenis', "");
			$dataJsonGenerate = array("status" => "gagal", "msg" => "Maaf Login Gagal. Silahkan cek kembali username dan password anda.");
		}else{
			Session::put('nama', $users[0]->nama);
			Session::put('username', $users[0]->username);
			Session::put('jenis', $users[0]->jenis);
			$dataJsonGenerate = array("status" => "success", "msg" => "Login berhasil. Anda akan dialihkan ke Halaman Utama.");
		}
		return json_encode($dataJsonGenerate);
    }
    public function keluarAplikasi(){
		Session::put('nama', '');
		Session::put('username', '');
		Session::put('jenis', '');
		return view('beranda');
    }
}
