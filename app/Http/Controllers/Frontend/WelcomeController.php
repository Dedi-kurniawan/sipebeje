<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\BaseController as Controller;
use App\Models\Desa;
use App\Models\Paket;
use App\Models\Vendor;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $bread = $this->bread('Beranda', 'LOGIN', 'Formulir', url('/'));
        $data = [
            'desa'   => Desa::count(),
            'vendor' => Vendor::count(),
            'paket_semua'    => Paket::where('status', '!=', 'draft')->count(),
            'paket_selesai'  => Paket::where('status', 'selesai')->count(),
        ];
        $paket = Paket::where('status', '!=', 'draft')->with('desa')->get();
        return view('frontend.welcome.index', compact('bread', 'data', 'paket'));
    }

    public function show($id)
    {
        $bread = $this->bread('Beranda', 'LOGIN', 'Formulir', url('/'));
        $show = Paket::where('id', $id)->with(['akk', 'undangan', 'hpsTable'])->firstOrFail();
        return view('frontend.welcome.show', compact('bread', 'show'));
    }

    public function kontak()
    {
        $bread = $this->bread('KONTAK KAMI', 'KONTAK KAMI', 'KONTAK KAMI', url('/'));
        return view('frontend.welcome.kontak', compact('bread'));
    }
}
