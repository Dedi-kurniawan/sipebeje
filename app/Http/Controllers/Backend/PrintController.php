<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Models\Paket;
use App\Models\UndanganMaterial;
use App\Models\UndanganVendor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

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
        // return $pdf->setPaper('a4', 'potrait')->stream();
        // return view('backend.paket.cetak.print_undangan', compact('undanganVendor'));
    }

    public function printStepPertama($id)
    {
        $akses = $this->aksesRole();
        $paket = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with(['akk', 'hpsTable'])->firstOrFail();
        $pdf   = PDF::loadView('backend.paket.cetak.step_pertama_print', compact('paket'));
        // return $pdf->setPaper('a4', 'potrait')->stream();
        $fileName = sprintf('%s_step_pertama.pdf', Str::slug($paket->desa->nama));
        return $pdf->setPaper('a4', 'potrait')->download($fileName);
    }

    public function printStepKedua($id)
    {
        $akses = $this->aksesRole();
        $paket = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with(['evaluasiPenawaran', 'negoHarga', 'suratPerjanjian', 'desa', 'vendor', 'vendor.user'])->firstOrFail();
        if ($paket->akk_field == "0") {
            if ($akses['role'] == 'desa') {
                return redirect()->route('admin.akk.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'LENGKAPI KAK DI STEP SATU TERLEBIH DAHULU']);
            }
            return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP SATU', 'message' => 'OPERATOR DESA BELUM MELENGKAPI KAK DI STEP SATU']);            
        }

        // if ($paket->hps_field == "0") {
        //     if ($akses['role'] == 'desa') {
        //         return redirect()->route('admin.hps.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP SATU', 'message' => 'LENGKAPI HPS DI STEP SATU TERLEBIH DAHULU']);
        //     }
        //     return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP SATU', 'message' => 'OPERATOR DESA BELUM MELENGKAPI HPS DI STEP SATU']);
        // }

        if ($paket->undangan_field == "0") {
            if ($akses['role'] == 'desa') {
                return redirect()->route('admin.undangan.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP SATU', 'message' => 'LENGKAPI UNDANGAN DI STEP SATU TERLEBIH DAHULU']);
            }
            return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP SATU', 'message' => 'OPERATOR DESA BELUM MELENGKAPI UNDANGAN DI STEP SATU']);
        }

        if ($paket->evaluasi_field == "0") {
            if ($akses['role'] == 'desa') {
                return redirect()->route('admin.evaluasi-penawaran.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'LENGKAPI EVALUASI PENAWARAN DI STEP DUA TERLEBIH DAHULU']);
            }
            return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'OPERATOR DESA BELUM MELENGKAPI EVALUASI PENAWARAN DI STEP DUA']);
        }

        if ($paket->hasil_evaluasi_field == "0") {
            if ($akses['role'] == 'desa') {
                return redirect()->route('admin.hasil-evaluasi-penawaran.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'LENGKAPI HASIL EVALUASI PENAWARAN DI STEP DUA TERLEBIH DAHULU']);
            }
            return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'OPERATOR DESA BELUM MELENGKAPI HASIL EVALUASI PENAWARAN DI STEP DUA']);
        }

        if ($paket->nego_harga_field == "0") {
            if ($akses['role'] == 'desa') {
                return redirect()->route('admin.nego-harga.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'LENGKAPI HASIL HASIL NEGO HARGA DI STEP DUA TERLEBIH DAHULU']);
            }
            return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'OPERATOR DESA BELUM MELENGKAPI HASIL HASIL NEGO HARGA DI STEP DUA']);
        }

        if ($paket->perjanjian_field == "0") {
            if ($akses['role'] == 'desa') {
                return redirect()->route('admin.surat-perjanjian.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'LENGKAPI HASIL SURAT PERJANJIAN DI STEP DUA TERLEBIH DAHULU']);
            }
            return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'OPERATOR DESA BELUM MELENGKAPI HASIL SURAT PERJANJIAN DI STEP DUA']);
        }

        $pdf = PDF::loadView('backend.paket.cetak.step_kedua', compact('paket'));
        $fileName = sprintf('%s_step_kedua.pdf', Str::slug($paket->desa->nama));
        return $pdf->setPaper('a4', 'potrait')->download($fileName);
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
