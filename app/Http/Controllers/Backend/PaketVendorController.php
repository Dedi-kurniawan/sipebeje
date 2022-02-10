<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketVendorController extends Controller
{
    public function index()
    {
        $bread = $this->bread('Main Menu', 'Paket', 'Table', route('admin.undangan.paket'));
        return view('backend.paketVendor.index', compact('bread'));
    }

    public function show($id)
    {
        $bread    = $this->bread('Main Menu', 'Paket', 'Detail Paket', route('admin.undangan.paket'));
        $akses    = $this->aksesRole();
        $show     = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with(['akk', 'hpsTable', 'undanganVendor'])->firstOrFail();
        return view('backend.paketVendor.show', compact('bread', 'show'));
    }
}
