<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\BaseController as Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index()
    {
        $bread = $this->bread('Home', 'Registrasi', 'Formulir', url('/'));
        return view('frontend.register.index', compact('bread'));
    }

    public function store(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $data    = $this->uploadRequest($request);
            $user    = User::create($data);
            $subject = 'PENDAFTARAN AKUN SIPEBEJE - BENGKULU UTARA';
            $email   = $this->sendEmail($user, $subject);
            if ($email == "Gagal") {
                DB::rollback();
                return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'DAFTAR AKUN', 'message' => $request->email.' tidak di temukan']);
            }
            DB::commit();
            return redirect()->route('frontend.confirm.email', $user->confirm_url);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'DAFTAR AKUN', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }
    public function uploadRequest($request)
    {
        $data = $request->all();
        $data['confirmation_code'] = date('Ymdhis') . '-' . Str::random(30);
        $data['confirm_url'] = Str::random(60) . '-' . date('Ymdhis');
        $data['password'] = Hash::make($request->password);
        $data['role'] = 'vendor';
        $url = $request->name . '-' . Str::random(100) . '-' . date('Ymdhis');
        $data['url_name'] = Str::slug($url);
        return $data;
    }

    public function confirm($url)
    {
        $bread = $this->bread('Home', 'VERIFIKASI', 'KONFIRMASI', url('/'));
        $user  = User::where('confirm_url', $url)->firstOrFail();
        return view('frontend.register.confirm', compact('user', 'bread'));
    }

    public function confirmPost($url)
    {
        $user = User::where('confirm_url', $url)->firstOrFail();
        if ($user) {
            if ($user->confirmed == '0') {
                $subject = 'PENDAFTARAN AKUN SIPEBEJE - BENGKULU UTARA';
                $email   = $this->sendEmail($user, $subject);
                return redirect()->back()->with(['status' => 'success',  'message' => 'Link verifikasi sudah terkirim ke ' . $user->email]);
            } else {
                return redirect()->route('auth.login')->with(['status' => 'success', 'action' => 'add', 'title' =>  'LOGIN', 'message' => 'Anda telah berhasil memverifikasi email']);
            }
        } else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }


    public function verify($code)
    {
        if (!$code) {
            abort('404');
        }

        $user = User::where('confirmation_code', $code)->first();

        if (!$user) {
            abort('404');
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
        return redirect()->route('frontend.login')->with(['status' => 'success',  'message' => 'Anda telah berhasil memverifikasi akun Anda']);
    }

    public function sendEmail($user, $subject)
    {
        // dd($user);
        $email   = $user->email;
        $data    = array(
            'confirmation_code' => $user->confirmation_code,
            'name' => $user->name,
        );
        Mail::send('frontend.register.email', $data, function ($mail) use ($email, $subject) {
            $mail->to($email)
                ->subject($subject);
            $mail->from(env('MAIL_SENDER'), "SIKO Bengkulu Utara");
        });
        if (Mail::failures()) {
            $res =  "Gagal";
        } else {
            $res =  "Terkirim!";
        }
        return $res;
    }
}
