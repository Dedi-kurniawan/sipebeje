<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Models\Paket;
use App\Models\UndanganMaterial;
use App\Models\UndanganVendor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function cetakUndangan($id)
    {
        $bread = $this->bread('PAKET', 'UNDANGAN', 'CETAK', route('admin.paket.index'));
        $akses = $this->aksesRole();
        $paket = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->firstOrFail();
        return view('backend.paket.cetak.undangan', compact('bread', 'paket'));
    }

    public function printUndangan(Request $request)
    {
        $akses    = $this->aksesRole();
        // Paket::where('id', $request->paket_id)->OfDesaId($akses['desa_id'])->firstOrFail();
        $paket = Paket::where('id', $request->paket_id)->OfDesaId($akses['desa_id'])->with(['hpsTable'])->firstOrFail();
        $undanganVendor = UndanganVendor::where('paket_id', $request->paket_id)
                                         ->where('vendor_id', $request->vendor_id)
                                         ->with(['vendor', 'undangan', 'paket', 'paket.desa', 'paket.kecamatan', 'paket.aparatur'])->first();
        // $undanganMaterial = UndanganMaterial::where('undangan_id', $request->undangan_id)->get();
        $pdf = PDF::loadView('backend.paket.cetak.print_undangan', compact('undanganVendor', 'paket'));
        return $pdf->download('surat_undangan.pdf');
        // $pdf = PDF::loadView('backend.paket.cetak.print_undangan', compact('undanganVendor'));    
        // return $pdf->stream();
        // return view('backend.paket.cetak.print_undangan', compact('undanganVendor'));
    }

    public function printStepPertama($id)
    {
        $akses = $this->aksesRole();
        $paket = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with(['akk', 'hpsTable'])->firstOrFail();
        $pdf   = PDF::loadView('backend.paket.cetak.step_pertama_print', compact('paket'));
        return $pdf->setPaper('a4', 'potrait')->stream();
    }

    public function printStepKedua($id)
    {
        $akses = $this->aksesRole();
        $paket = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with(['evaluasiPenawaran', 'negoHarga', 'suratPerjanjian', 'desa', 'vendor', 'vendor.user'])->firstOrFail();
        $pdf   = PDF::loadView('backend.paket.cetak.step_kedua', compact('paket'));
        return $pdf->setPaper('a4', 'potrait')->stream();
    }

    public function printKak($id)
    {
        $akses = $this->aksesRole();
        $paket = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with(['akk'])->firstOrFail();
        $pdf   = PDF::loadView('backend.paket.cetak.kak', compact('paket'));
        return $pdf->setPaper('a4', 'potrait')->download($paket->nama.'.pdf');
        // return view('backend.paket.cetak.kak', compact('paket'));
    }

    public function printHps($id)
    {
        $akses = $this->aksesRole();
        $paket = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with(['hpsTable'])->firstOrFail();
        $pdf   = PDF::loadView('backend.paket.cetak.hps', compact('paket'));
        return $pdf->setPaper('a4', 'potrait')->download($paket->nama.'.pdf');
        // return $pdf->setPaper('a4', 'potrait')->download($paket->nama.'.pdf');
        // return view('backend.paket.cetak.kak', compact('paket'));
    }

}
