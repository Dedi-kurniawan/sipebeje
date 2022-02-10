<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\AkkRequest;
use App\Http\Requests\HpsRequest;
use App\Http\Requests\PaketRequest;
use App\Models\Akk;
use App\Models\Aparatur;
use App\Models\EvaluasiPenawaran;
use App\Models\Hps;
use App\Models\NegoHarga;
use App\Models\Paket;
use App\Models\SuratPerjanjian;
use App\Models\Undangan;
use App\Models\Vendor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketController extends Controller
{
    public function index()
    {
        $bread = $this->bread('Main Menu', 'Paket', 'Table', route('admin.paket.index'));
        $akses = $this->aksesRole();
        $aparatur = Aparatur::where('desa_id', $akses['desa_id'])->get();
        return view('backend.paket.index', compact('bread', 'aparatur'));
    }

    public function create()
    {
        $bread = $this->bread('Main Menu', 'Paket', 'Formulir', route('admin.paket.index'));
        return view('backend.paket.create', compact('bread'));
    }

    public function store(PaketRequest $request)
    {
        DB::beginTransaction();
        try {
            $akses = $this->aksesRole();
            $data  = $request->all();
            $data['desa_id'] = $akses['desa_id'];
            $data['kecamatan_id'] = $akses['kecamatan_id'];
            $data['status'] = 'draft';
            $rupiah = str_replace('.', '', $request->hps);
            $data['hps'] = substr($rupiah, 0, -3);
            $create = Paket::create($data);
            Akk::create([
                'paket_id' => $create->id
            ]);
            Undangan::create([
                'paket_id' => $create->id
            ]);
            EvaluasiPenawaran::create([
                'paket_id' => $create->id
            ]);
            NegoHarga::create([
                'paket_id' => $create->id
            ]);
            SuratPerjanjian::create([
                'paket_id' => $create->id
            ]);
            DB::commit();
            return redirect()->route('admin.paket.edit', $create->id);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'TAMBAH PAKET', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function show($id)
    {
        $bread    = $this->bread('Main Menu', 'Paket', 'Detail Paket', route('admin.paket.index'));
        $akses    = $this->aksesRole();
        $show     = Paket::where('id', $id)->OfDesaId($akses['desa_id'])->with(['akk', 'hpsTable', 'undanganVendor'])->firstOrFail();
        return view('backend.paket.show', compact('bread', 'show'));
    }

    public function edit($id)
    {
        $bread    = $this->bread('STEP PERTAMA', 'Paket', 'Formulir', route('admin.paket.index'));
        $akses    = $this->aksesRole();
        $aparatur = Aparatur::where('desa_id', $akses['desa_id'])->get();
        $edit     = Paket::where('id', $id)->where('desa_id', $akses['desa_id'])->firstOrFail();
        $tab      = "paket";
        return view('backend.paket.edit', compact('bread', 'aparatur', 'edit', 'tab'));
    }

    public function update(PaketRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data   = $request->all();
            $rupiah = str_replace('.', '', $request->hps);
            $harga  = substr($rupiah, 0, -3);
            $data['hps'] = $harga;
            $update = Paket::findOrFail($id);
            $update->update($data);
            DB::commit();
            if ($update->akk_field == "0") {
                return redirect()->route('admin.akk.edit', $update->id)->with(['status' => 'success', 'action' => 'success', 'title' =>  'UBAH PAKET', 'message' => 'UBAH PAKET BERHASIL']);
            }

            if ($update->hps_field == "0") {
                return redirect()->route('admin.hps.edit', $update->id)->with(['status' => 'success', 'action' => 'success', 'title' =>  'UBAH PAKET', 'message' => 'UBAH PAKET BERHASIL']);
            }

            if ($update->undangan_field == "0") {
                return redirect()->route('admin.undangan.edit', $update->id)->with(['status' => 'success', 'action' => 'success', 'title' =>  'UBAH PAKET', 'message' => 'UBAH PAKET BERHASIL']);
            }
            return redirect()->route('admin.paket.edit', $update->id)->with(['status' => 'success', 'action' => 'success', 'title' =>  'UBAH PAKET', 'message' => 'UBAH PAKET BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'TAMBAH PAKET', 'message' => 'UBAH PAKET BERHASIL']);
        }
    }

    public function editAkk($id)
    {
        $bread    = $this->bread('STEP PERTAMA', 'KERANGKA ACUAN KERJA (KAK)', 'Formulir', route('admin.paket.index'));
        $akses    = $this->aksesRole();
        $tab      = "akk";
        $edit     = Paket::where('id', $id)->where('desa_id', $akses['desa_id'])->with('akk')->firstOrFail();
        return view('backend.paket.akk', compact('bread', 'edit', 'tab'));
    }

    public function updateAkk(AkkRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data   = $request->all();
            $rupiah = str_replace('.', '', $request->pagu_anggaran_rp);
            $data['pagu_anggaran_rp'] = substr($rupiah, 0, -3);
            $akses  = $this->aksesRole();
            $paket  = Paket::where('id', $id)->where('desa_id', $akses['desa_id'])->with('akk')->firstOrFail();
            $paket->update([
                'akk_field' => '1'
            ]);
            $update = Akk::findOrFail($paket->akk->id);
            $update->update($data);
            DB::commit();
            if ($paket->hps_field == "0") {
                return redirect()->route('admin.hps.edit', $paket->id)->with(['status' => 'success', 'action' => 'success', 'title' =>  'UBAH KAK', 'message' => 'UBAH KAK BERHASIL']);;
            }

            if ($paket->undangan_field == "0") {
                return redirect()->route('admin.undangan.edit', $paket->id)->with(['status' => 'success', 'action' => 'success', 'title' =>  'UBAH KAK', 'message' => 'UBAH KAK BERHASIL']);;
            }
            return redirect()->route('admin.paket.edit', $paket->id)->with(['status' => 'success', 'action' => 'success', 'title' =>  'UBAH KAK', 'message' => 'UBAH KAK BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'UBAH KAK', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function editHps($id)
    {
        $bread    = $this->bread('STEP PERTAMA', 'Harga Perkiraan Sendiri (HPS)', 'Formulir', route('admin.paket.index'));
        $akses    = $this->aksesRole();
        $edit     = Paket::where('id', $id)->where('desa_id', $akses['desa_id'])->firstOrFail();
        $tab      = "hps";
        return view('backend.paket.hps', compact('bread', 'edit', 'tab'));
    }

    public function storeHps(HpsRequest $request)
    {
        DB::beginTransaction();
        try {
            $akses  = $this->aksesRole();
            $paket  = Paket::where('id', $request->paket_id)->where('desa_id', $akses['desa_id'])->firstOrFail();
            $paket->update([
                'hps_field' => '1'
            ]);
            $data   = $request->all();
            $rupiah = str_replace('.', '', $request->harga_satuan);
            $harga = substr($rupiah, 0, -3);
            $jumlah = $harga * $request->volume;
            $data['harga_satuan'] = $harga;
            $data['jumlah']       = $jumlah;
            if ($request->pajak == "0") {
                $data['harga_pajak']  =  $jumlah;
            } else {
                $data['harga_pajak']  = ($request->pajak / 100) * $jumlah;
            }
            $create = Hps::create($data);
            DB::commit();
            return response()->json(['status' => 'success', 'action' => 'success', 'message' => 'TAMBAH HPS ' . $create->uraian . ' BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'action' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function destroyHps($id)
    {
        DB::beginTransaction();
        try {
            $delete = Hps::findOrFail($id);
            $hps = Hps::where('paket_id', $delete->paket_id)->count();
            if ($hps == "1") {
                $paket  = Paket::where('id', $delete->paket_id)->firstOrFail();
                $paket->update([
                    'hps_field' => '0'
                ]);
            }
            $delete->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'HAPUS ' . $delete->uraian . ' BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $akses  = $this->aksesRole();
            $delete = Paket::where('id', $id)->where('desa_id', $akses['desa_id'])->firstOrFail();
            if ($akses['role'] == "desa") {
                if ($delete->status != "selesai") {
                    $delete->delete();
                    DB::commit();
                    return response()->json(['status' => 'success', 'message' => 'HAPUS '. $delete->nama. ' BERHASIL']);
                }else {
                    return response()->json(['status' => 'error', 'message' => 'Hanya Admin kabupaten yang di izinkan hapus data']);
                }
            }            
            $delete->delete();
            return response()->json(['status' => 'success', 'message' => 'HAPUS '. $delete->nama. ' BERHASIL']);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'HAPUS '. $delete->nama. ' BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function rupiahTerbilang(Request $request)
    {
        $str_replace = str_replace('.', '', $request->rupiah);
        $rupiah = $this->convert(substr($str_replace, 0, -3));
        return response()->json(['status' => 'success', 'rupiah' => $rupiah]);
    }

    public function getVendor(Request $request)
    {
        $data     = Vendor::where('desa_id', $request->desa_id)->get();
        $selected = $request->village_id;
        $title    = "Vendor";
        $select   = view('layouts.backend.partials.select', compact('data', 'title', 'selected'))->render();
        return response()->json(['options' => $select]);
    }
}
