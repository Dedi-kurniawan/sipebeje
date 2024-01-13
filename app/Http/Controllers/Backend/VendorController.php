<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\VendorRequest;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Vendor::with(['kecamatan:id,nama', 'desa:id,nama', 'user:id,name,vendor_id,status'])->limit(10)->orderby('nama_perusahaan', 'asc')->get();
        // dd($data);
        $bread = $this->bread('Main Menu', 'Vendor', 'Table', route('admin.vendor.index'));
        $kecamatan = Kecamatan::select('id', 'nama')->get();
        $akses = $this->aksesRole();
        return view('backend.vendor.index', compact('bread', 'kecamatan', 'akses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bread = $this->bread('Main Menu', 'Vendor', 'Tambah Baru', route('admin.vendor.index'));
        $kecamatan = Kecamatan::select('id', 'nama')->get();
        $kategori = Kategori::where('status', 1)->get();
        return view('backend.vendor.create', compact('bread', 'kecamatan', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {
        DB::beginTransaction();
        try {
            $data   = $request->only(['nama_perusahaan', 'alamat', 'email_perusahaan', 'telepon', 'kecamatan_id', 'desa_id', 'npwp', 'deskripsi', 'kategori_id']);
            $akses  = $this->aksesRole();
            $create = Vendor::create($data); 
            $user = User::create([
                'name'      => $request->name,
                'password'  => Hash::make($request->password),
                'email'     => $request->email,
                'role'      => 'vendor',
                'confirmed' => '1',
                'status'    => '1',
                'vendor_id' => $create->id
            ]);            
            DB::commit();
            return redirect()->back()->with(['status' => 'success', 'action' => 'success', 'title' => 'TAMBAH DATA', 'message' => $create->nama_perusahaan.'  BERHASIL DI TAMBAH']);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->with(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bread = $this->bread('Main Menu', 'Vendor', 'Detail', route('admin.vendor.index'));
        $show = Vendor::with(['user', 'kecamatan', 'desa'])->findOrFail($id);
        return view('backend.vendor.show', compact('bread', 'show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bread = $this->bread('Main Menu', 'Vendor', 'Ubah', route('admin.vendor.index'));
        $edit = Vendor::with('user')->findOrFail($id);
        $kecamatan = Kecamatan::select('id', 'nama')->get();
        $kategori = Kategori::where('status', 1)->get();
        return view('backend.vendor.edit', compact('bread', 'kecamatan', 'edit', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data_user = $request->only(['email', 'name']);
            if ($request->password != "") {
                $data_user['password'] = Hash::make($request->password);
            }
            $user   = User::findOrFail($request->user_id);
            $user->update($data_user); 
            $data = $request->except(['name', 'email']);
            $update = Vendor::findOrFail($id);
            $update->update($data); 
            DB::commit();
            return redirect()->route('admin.vendor.index')->with(['status' => 'success', 'action' => 'success', 'title' => 'UBAH DATA', 'message' => $update->nama_perusahaan.'  BERHASIL DI UBAH']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $delete = Vendor::findOrFail($id);
            $user = User::where('vendor_id', $delete->id)->firstOrFail();
            $user->delete();
            $delete->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'HAPUS DATA '. $delete->nama_perusahaan. ' BERHASIL']);  
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }
}
