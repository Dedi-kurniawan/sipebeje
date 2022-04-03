<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\ProfileDesaRequest;
use App\Http\Requests\ProfileVendorRequest;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function vendor()
    {
        $bread     = $this->bread('PROFILE PERUSAHAAN', 'Profile Usaha', 'Profile Usaha', route('admin.profile.vendor'));
        $kecamatan = Kecamatan::select('id', 'nama')->get();
        $user      = User::with('vendor')->findOrFail($this->userId());
        $edit = [
            'name' => $user->name,
            'email' => $user->email,
            'nama_perusahaan' => $user->vendor_id == NULL ? '' : $user->vendor->nama_perusahaan,
            'alamat' => $user->vendor_id == NULL ? '' : $user->vendor->alamat,
            'npwp' => $user->vendor_id == NULL ? '' : $user->vendor->npwp,
            'email_perusahaan' => $user->vendor_id == NULL ? '' : $user->vendor->email_perusahaan,
            'telepon' => $user->vendor_id == NULL ? '' : $user->vendor->telepon,
            'kecamatan_id' => $user->vendor_id == NULL ? '' : $user->vendor->kecamatan_id,
            'desa_id' => $user->vendor_id == NULL ? '' : $user->vendor->desa_id,
            'kategori_id' => $user->vendor_id == NULL ? '' : $user->vendor->kategori_id,
        ];

        return view('backend.profile.vendor', compact('bread', 'edit', 'kecamatan'));
    }

    public function vendorPost(ProfileVendorRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($this->userId());
            if ($user->vendor_id == NULL) {
                $vendor = Vendor::create($request->all());
                $user->update([
                    'vendor_id' => $vendor->id,
                    'full_field' => '1'
                ]);
            } else {
                $vendor = Vendor::findOrFail($user->vendor_id);
                $vendor->update($request->all());
            }
            DB::commit();
            return redirect()->back()->with(['status' => 'success', 'action' => 'success', 'title' =>  'PROFILE PERUSAHAAN', 'message' => 'profile berhasil di update']);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function desa()
    {
        $bread = $this->bread('PROFILE DESA', 'Profile Desa', 'Profile Desa', route('admin.profile.desa'));
        $desa  = User::with('desa')->findOrFail($this->userId());
        return view('backend.profile.desa', compact('bread', 'desa'));
    }

    public function desaPost(ProfileDesaRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($this->userId());
            $user->update([
                'full_field' => '1'
            ]);
            $desa = Desa::findOrFail($user->desa_id);
            $data = $request->except('logo');
            // $dir = "";
            // $imageName = date('Ymdhis').'.'.$request->logo->extension();   
            // $request->logo->move(public_path('template/images/desa/'), $imageName);
            // $data['logo'] = $imageName;
            $desa->update($data);
            DB::commit();
            return redirect()->back()->with(['status' => 'success', 'action' => 'success', 'title' =>  'PROFILE DESA', 'message' => 'profile berhasil di update']);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' =>  'PROFILE DESA', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function akun()
    {
        $bread = $this->bread('PROFILE AKUN', 'Profile Akun', 'Profile Akun', route('admin.profile.akun'));
        $akun  = User::findOrFail($this->userId());
        return view('backend.profile.akun', compact('bread', 'akun'));
    }

    public function akunPost(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($this->userId());
            $data = $request->except('password');
            if ($request->password) {
                $data['password'] = Hash::make($request->password);  
            }
            $user->update($data);
            DB::commit();
            return redirect()->back()->with(['status' => 'success', 'action' => 'success', 'title' =>  'PROFILE AKUN', 'message' => 'akun berhasil di update']);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' =>  'PROFILE AKUN', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
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
