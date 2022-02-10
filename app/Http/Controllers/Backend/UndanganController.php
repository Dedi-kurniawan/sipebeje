<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\UndanganMaterialRequest;
use App\Http\Requests\UndanganRequest;
use App\Http\Requests\UndanganVendorRequest;
use App\Models\Desa;
use App\Models\Paket;
use App\Models\Undangan;
use App\Models\UndanganMaterial;
use App\Models\UndanganVendor;
use App\Models\User;
use App\Notifications\UndanganNotification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UndanganController extends Controller
{
    public function editUndangan($id)
    {
        $bread    = $this->bread('Main Menu', 'UNDANGAN', 'Formulir', route('admin.paket.index'));
        $akses    = $this->aksesRole();
        $edit     = Paket::where('id', $id)->where('desa_id', $akses['desa_id'])->with('undangan')->firstOrFail();
        $tab      = "undangan";
        $desa_id  = $akses['desa_id'];
        $desa     = Desa::select('id', 'nama')->get(); 
        return view('backend.paket.undangan', compact('bread', 'edit', 'tab', 'desa', 'desa_id'));
    }

    public function updateUndangan(UndanganRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $akses = $this->aksesRole();
            $paket = Paket::where('id', $id)->where('desa_id', $akses['desa_id'])->with('undangan')->firstOrFail();
            if ($paket->hps_field == "0") {
                return redirect()->route('admin.hps.edit', $id)->with(['status' => 'success', 'action' => 'success', 'title' =>  'KIRIM UNDANGAN', 'message' => 'SILAHKAN LENGKAPI HPS SEBELUM MENGIRIM UNDANGAN']);
            }

            if ($paket->akk_field == "0") {
                return redirect()->route('admin.akk.edit', $id)->with(['status' => 'success', 'action' => 'success', 'title' =>  'KIRIM UNDANGAN', 'message' => 'SILAHKAN LENGKAPI KAK SEBELUM MENGIRIM UNDANGAN']);
            }

            $vendor = UndanganVendor::where('undangan_id', $paket->undangan->id)->firstOrFail();
            if (!$vendor) {
                return redirect()->route('admin.undangan.edit', $id)->with(['status' => 'error', 'action' => 'error', 'title' =>  'KIRIM UNDANGAN', 'message' => 'SILAHKAN LENGKAPI VENDOR SEBELUM MENGIRIM UNDANGAN']);
            }
            $data   = $request->all();
            $rupiah = str_replace('.', '', $request->nilai_total);
            $data['nilai_total'] = substr($rupiah, 0, -3);
            $update = Undangan::findOrFail($paket->undangan->id);
            $update->update($data);
            $paket->update([
                'undangan_field' => '1',
                'status' => 'proses'
            ]);

            if ($paket->undangan_field == "0") {
                $notification = [
                    'title' => 'UNDANGAN',
                    'notif' => $paket->nama,
                    'date'  => date('Y-m-d H:i:s'),
                    'id'    => $paket->id,
                ];
                $this->sendNotification($notification, $paket->undangan->id);
            }        
            DB::commit();    
            return redirect()->route('admin.paket.index');
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->with(['status' => 'error', 'action' => 'error', 'title' =>  'KIRIM UNDANGAN', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function addVendor(UndanganVendorRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            UndanganVendor::create($data);
            DB::commit(); 
            return response()->json(['status' => 'success', 'action' => 'success', 'message' => 'TAMBAH VENDOR BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'action' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function destroyVendor($id)
    {
        DB::beginTransaction();
        try {
            $delete = UndanganVendor::findOrFail($id);
            $delete->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'HAPUS '. $delete->vendor->nama_perusahaan. ' BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function addMaterial(UndanganMaterialRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $rupiah = str_replace('.', '', $request->harga_satuan);
            $harga = substr($rupiah, 0, -3);
            $data['harga_satuan'] = $harga;
            UndanganMaterial::create($data);
            DB::commit(); 
            return response()->json(['status' => 'success', 'action' => 'success', 'message' => 'TAMBAH MATERIAL BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'action' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function destroyMaterial($id)
    {
        DB::beginTransaction();
        try {
            $delete = UndanganMaterial::findOrFail($id);
            $delete->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'HAPUS MATERIAL BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function sendNotification($notification, $undangan_id)
    {
        $notification = [
            'title' => $notification['title'],
            'notif' => $notification['notif'],
            'date'  => $notification['date'],
            'id'    => $notification['id'],
        ];
        $undangan = UndanganVendor::where('undangan_id', $undangan_id)->get();
        foreach($undangan as $a){
            $user = User::where('vendor_id', $a->vendor_id)->get();
            foreach ($user as $u) {
                $u->notify(new UndanganNotification($notification));
            }            
        }
        return true;
    }
}
