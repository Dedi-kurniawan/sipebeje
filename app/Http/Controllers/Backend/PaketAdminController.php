<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class PaketAdminController extends Controller
{
    public function index()
    {
        $bread = $this->bread('Main Menu', 'PAKET', 'Table', route('admin.paket-admin.index'));
        $kecamatan = Kecamatan::select('id', 'nama')->get();
        $akses = $this->aksesRole();
        return view('backend.paketAdmin.index', compact('bread', 'kecamatan', 'akses'));
    }
}
