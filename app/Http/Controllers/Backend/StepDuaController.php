<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Models\EvaluasiPenawaran;
use App\Models\HasilEvaluasiPenawaran;
use App\Models\NegoHarga;
use App\Models\Paket;
use App\Models\SuratPerjanjian;
use App\Models\UndanganVendor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class StepDuaController extends Controller
{
    public function evaluasiPenawaran($id)
    {
        $bread = $this->bread('STEP KEDUA', 'Evaluasi Penawaran', 'Formulir', route('admin.paket.index'));
        $akses = $this->aksesRole();
        $paket = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with('evaluasiPenawaran')->firstOrFail();
        if ($paket->akk_field == "0") {
            return redirect()->route('admin.akk.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'LENGKAPI STEP SATU TERLEBIH DAHULU']);
        }

        // if ($paket->hps_field == "0") {
        //     return redirect()->route('admin.hps.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'LENGKAPI STEP SATU TERLEBIH DAHULU']);
        // }

        if ($paket->undangan_field == "0") {
            return redirect()->route('admin.undangan.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'LENGKAPI STEP SATU TERLEBIH DAHULU']);
        }

        $tab = "evaluasi-penawaran";
        return view('backend.paket.stepdua.evaluasi_penawaran', compact('bread', 'paket', 'tab'));
    }

    public function evaluasiPenawaranUpdate(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $akses = $this->aksesRole();
            $paket = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with('evaluasiPenawaran')->firstOrFail();
            $paket->update([
                'evaluasi_field' => '1'
            ]);
            $update = EvaluasiPenawaran::findOrFail($paket->evaluasiPenawaran->id);
            $update->update($data);
            DB::commit();
            return redirect()->route('admin.hasil-evaluasi-penawaran.edit', $id)->with(['status' => 'success', 'action' => 'success', 'title' =>  'BERITA ACARA EVALUASI HARGA', 'message' => 'UBAH BERITA ACARA EVALUASI HARGA BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'BERITA ACARA EVALUASI HARGA', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function hasilEvaluasiPenawaran($id)
    {
        $bread = $this->bread('STEP KEDUA', 'Hasil Evaluasi Penawaran', 'Formulir', route('admin.paket.index'));
        $akses  = $this->aksesRole();
        $paket  = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->firstOrFail();
        $vendor = UndanganVendor::where('undangan_id', $paket->undangan->id)->where('status', '2')->get();
        $tab    = "hasil-evaluasi-penawaran";
        return view('backend.paket.stepdua.hasil_evaluasi_penawaran', compact('bread', 'paket', 'tab', 'vendor'));
    }

    public function hasilEvaluasiPenawaranStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $hasil  = DB::table('hasil_evaluasi_penawaran')->where('paket_id', $request->paket_id)->where('vendor_id', $request->vendor_id)->first();
            if ($hasil) {
                return response()->json(['status' => 'error', 'action' => 'error', 'message' => 'VENDOR SUDAH DI EVALUASI']);
            }

            if ($request->kesimpulan == "lulus") {
                 $lulus  = DB::table('hasil_evaluasi_penawaran')->where('paket_id', $request->paket_id)->where('kesimpulan', 'lulus')->first();
                if ($lulus) {
                    return response()->json(['status' => 'error', 'action' => 'error', 'message' => 'HASIL EVALUASI PENAWARAN SUDAH ADA YANG LULUS']);
                }
                $paket  = Paket::where('id', $request->paket_id)->first();
                $paket->update([
                    'vendor_id' => $request->vendor_id,
                ]);
            }
            $create = DB::table('hasil_evaluasi_penawaran')->insert([
                'npwp' => $request->npwp,
                'vendor_id' => $request->vendor_id,
                'paket_id' => $request->paket_id,
                'surat_penawaran' => $request->surat_penawaran,
                'harga' => $request->harga,
                'kesimpulan' => $request->kesimpulan,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::commit();
            return response()->json(['status' => 'success', 'action' => 'success', 'title' =>  'HASIL EVALUASI', 'message' => 'TAMBAH HASIL EVALUASI PENAWARAN BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'action' => 'error', 'title' =>  'HASIL EVALUASI', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function hasilEvaluasiPenawaranDestroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $delete = HasilEvaluasiPenawaran::find($id);
            if ($delete->kesimpulan == "lulus") {
                $paket  = Paket::where('id', $request->paket_id)->first();
                $paket->update([
                    'vendor_id' => NULL,
                ]);
            }
            $delete->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'action' => 'success', 'title' =>  'HASIL EVALUASI', 'message' => 'HAPUS EVALUASI VENDOR BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'action' => 'error', 'title' =>  'HASIL EVALUASI', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function hasilEvaluasiPenawaranField($id)
    {
        $paket  = Paket::where('id', $id)->first();
        $paket->update([
            'hasil_evaluasi_field' => '1',
        ]);
        return redirect()->route('admin.hasil-evaluasi-penawaran.edit', $id)->with(['status' => 'success', 'action' => 'success', 'title' =>  'BERITA ACARA EVALUASI PENAWARAN', 'message' => 'UBAH BERITA ACARA EVALUASI HARGA BERHASIL']);
    }

    public function negoHarga($id)
    {
        $bread = $this->bread('STEP KEDUA', 'Nego Harga', 'Formulir', route('admin.paket.index'));
        $akses  = $this->aksesRole();
        $paket  = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with('negoHarga', 'evaluasiPenawaran')->firstOrFail();
        $tab    = "nego-harga";

        if (empty($paket->vendor_id)) {
            return redirect()->route('admin.hasil-evaluasi-penawaran.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'STEP DUA', 'message' => 'Vendor Belum Pilih']);
        }

        return view('backend.paket.stepdua.nego_harga', compact('bread', 'paket', 'tab'));
    }

    public function negoHargaUpdate(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data   = $request->all();
            $penawaran_rekanan = str_replace('.', '', $request->penawaran_rekanan);
            $data['penawaran_rekanan'] = substr($penawaran_rekanan, 0, -3);
            $penawaran_diajukan = str_replace('.', '', $request->penawaran_diajukan);
            $data['penawaran_diajukan'] = substr($penawaran_diajukan, 0, -3);
            $hasil_nego = str_replace('.', '', $request->hasil_nego);
            $data['hasil_nego'] = substr($hasil_nego, 0, -3);
            $harga_final = str_replace('.', '', $request->harga_final);
            $data['harga_final'] = substr($harga_final, 0, -3);
            $data['administrasi'] = 'mn';
            $data['harga'] = 'mn';
            $data['hasil_akhir'] = 'mn';
            $akses  = $this->aksesRole();
            $paket  = Paket::where('id', $id)->where('desa_id', $akses['desa_id'])->with('negoHarga')->firstOrFail();
            $paket->update([
                'nego_harga_field' => '1'
            ]);
            $update = NegoHarga::findOrFail($paket->negoHarga->id);
            $update->update($data);
            DB::commit();
            return redirect()->back()->with(['status' => 'success', 'action' => 'success', 'title' => 'BA NEGO HARGA', 'message' => 'UBAH BA NEGO HARGA BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'BA NEGO HARGA', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function suratPerjanjian($id)
    {
        $bread = $this->bread('STEP KEDUA', 'Surat Perjanjian', 'Formulir', route('admin.paket.index'));
        $akses  = $this->aksesRole();
        $paket  = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with('suratPerjanjian')->firstOrFail();
        $tab    = "surat-perjanjian";
        return view('backend.paket.stepdua.surat_perjanjian', compact('bread', 'paket', 'tab'));
    }

    public function suratPerjanjianUpdate(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data   = $request->all();
            $harga_final = str_replace('.', '', $request->harga_final);
            $data['harga_final'] = substr($harga_final, 0, -3);
            $nominal_denda = str_replace('.', '', $request->nominal_denda);
            $data['nominal_denda'] = substr($nominal_denda, 0, -3);
            $akses  = $this->aksesRole();
            $paket  = Paket::where('id', $id)->where('desa_id', $akses['desa_id'])->with('suratPerjanjian')->firstOrFail();
            $paket->update([
                'perjanjian_field' => '1',
                'status' => 'selesai'
            ]);
            $update = SuratPerjanjian::findOrFail($paket->suratPerjanjian->id);
            $update->update($data);
            DB::commit();
            return redirect()->route('admin.paket.index')->with(['status' => 'success', 'action' => 'success', 'title' => 'SURAT PERJNJIAN', 'message' => 'UBAH SURAT PERJNJIAN BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'SURAT PERJNJIAN', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }
}
