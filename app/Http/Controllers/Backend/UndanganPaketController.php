<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Models\Paket;
use App\Models\Undangan;
use App\Models\UndanganMaterial;
use App\Models\UndanganVendor;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UndanganPaketController extends Controller
{
    public function undangan()
    {
        $bread = $this->bread('Main Menu', 'Undangan', 'Konfirmasi Undangan', route('admin.undangan.paket'));
        return view('backend.undangan.index', compact('bread'));
    }

    public function undanganShow($id)
    {
        $bread = $this->bread('Main Menu', 'Paket', 'Detail Paket', route('admin.undangan.paket'));
        $show = UndanganVendor::where('id', $id)->where('vendor_id', $this->vendorId())->with(['paket', 'vendor', 'paket.desa'])->firstOrFail();
        // dd($show);
        return view('backend.undangan.show', compact('bread', 'show'));
    }

    public function undanganKonfirmasi($id)
    {
        $bread    = $this->bread('Main Menu', 'Undangan', 'Konfirmasi Undangan', route('admin.undangan.paket'));
        $show     = Paket::where('id', $id)->with(['desa', 'undangan', 'desa.kecamatan', 'hpsTable'])->firstOrFail();
        $undangan = UndanganVendor::where('undangan_id', $show->undangan->id)->where('vendor_id', $this->vendorId())->firstOrFail();
        return view('backend.undangan.undangan', compact('bread', 'show', 'undangan'));   
    }

    public function undanganKonfirmasiPost(Request $request)
    {
        DB::beginTransaction();
        try {
            $paket = Paket::where('id', $request->paket_id)->firstOrFail();
            if ($paket->tanggal_selesai < Carbon::now()->format('Y-m-d')) {
                return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' => 'KONFIRMASI UNDANGAN', 'message' => 'PENDAFTARAN SUDAH BERAKHIR']);
            }
            $undangan = UndanganVendor::where('undangan_id', $request->undangan_id)->where('vendor_id', $this->vendorId())->firstOrFail();
            $undangan->update([
                'status' => $request->submit
            ]);
            DB::commit();
            return redirect()->back()->with(['status' => 'success', 'action' => 'success', 'title' => 'KONFIRMASI UNDANGAN', 'message' => 'BERHASIL KONFIRMASI UNDANGAN']);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'KONFIRMASI UNDANGAN', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }
}
