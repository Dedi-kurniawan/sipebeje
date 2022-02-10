<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\BaseController as Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function formLogin()
    {
        $bread     = $this->bread('Home', 'LOGIN', 'Formulir', url('/'));
        return view('frontend.login.index', compact('bread'));
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $user = User::where('email', $request->email)->first(); 
        if ($user == null) {
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'LOGIN GAGAL', 'message' => 'Masukan Email & Password Dengan Benar']);   
        }else if($user->confirmed == "0"){
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'LOGIN GAGAL', 'message' => 'Silahkan Konfirmasi Email Terlebih Dahulu']);
        }else if($user->status == '1'){
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => '1'])){ 
                return redirect()->intended('/admin/dashboard');            
            }else{
                return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'LOGIN GAGAL', 'message' => 'Masukan Email & Password Dengan Benar !!!']);  
            }
        }else if($user->status == "0"){
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'LOGIN GAGAL', 'message' => 'Silahkan Hubungi Admin Untuk Mengaktifkan Kembali Akun Kamu !!!']);
        }else{
            return abort(404);
        }
    }
    
    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('frontend.welcome.index');
    }
}
