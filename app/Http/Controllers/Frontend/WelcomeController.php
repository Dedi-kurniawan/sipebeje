<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\BaseController as Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Paket;
use App\Models\Vendor;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $bread = $this->bread('Beranda', '', '', url('/'));
        $data = [
            'desa'   => Desa::count(),
            'vendor' => Vendor::count(),
            'paket_semua' => Paket::where('status', '!=', 'draft')->count(),
            'paket_selesai' => Paket::where('status', 'selesai')->count(),
        ];
        $kecamatan = Kecamatan::orderby('nama', 'asc')->get();
        $paket = Paket::OfKecamatanId($request->kecamatan)->OfDesaId($request->desa)->where('status', '!=', 'draft')->with(['desa', 'akk'])->get();
        return view('frontend.welcome.index', compact('bread', 'data', 'paket', 'kecamatan'));
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

    public function getDesa(Request $request)
    {
        $data = Desa::where('kecamatan_id', $request->kecamatan_id)->get();
        $selected = $request->desa_id;
        $title    = "Desa";
        $select   = view('layouts.backend.partials.action.select', compact('data', 'title', 'selected'))->render();
        return response()->json(['options' => $select]);
    }
}
