<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\SuratPesananRequest;
use App\Models\Aparatur;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

use App\Models\Satuan;
use App\Models\Desa;
use App\Models\SuratPesanan;
use App\Models\SuratPesananDetail;
use App\Models\Vendor;

class SuratPesananController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desa = Desa::select('desa.*');
        $aparatur = Aparatur::select('aparatur.*');
        $vendor = Vendor::select('vendor.*', 'users.name as name_vendor')
                        ->join('users', 'users.vendor_id', '=', 'vendor.id');

        $akses = $this->aksesRole();

        $desaId = null;
        if($akses['role'] == 'desa') {
            $aparatur->where('desa_id', $akses['desa_id']);
            $vendor->where('vendor.desa_id', $akses['desa_id']);
            $desa->where('desa.id', $akses['desa_id']);
            $desaId = $akses['desa_id'];
        }

        $aparatur = $aparatur->get();
        $vendor = $vendor->get();
        $desa = $desa->get();

        $bread = $this->bread('Master', 'Surat Pesanan', 'Table', route('admin.surat-pesanan.index'));
        return view('backend.suratPesanan.index', compact('bread', 'aparatur', 'vendor', 'desa', 'desaId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuratPesananRequest $request)
    {
        DB::beginTransaction();
        try {
            $akses = $this->aksesRole();
            $data  = $request->all();
            $data['desa_id'] = $akses['desa_id'];
            $create = SuratPesanan::create($data);
            DB::commit();
            return redirect()->route('admin.surat-pesanan.edit', $create->id);
            // return response()->json(['status' => 'success', 'message' => 'TAMBAH DATA ' .$create->nama. ' BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aparatur = Aparatur::select('aparatur.*');
        $vendor = Vendor::select('vendor.*', 'users.name as name_vendor')
                        ->join('users', 'users.vendor_id', '=', 'vendor.id');

        $akses = $this->aksesRole();

        if($akses['role'] == 'desa') {
            $aparatur->where('desa_id', $akses['desa_id']);
            $vendor->where('vendor.desa_id', $akses['desa_id']);
        }

        $aparatur = $aparatur->get();
        $vendor = $vendor->get();
        $satuan = Satuan::all();

        $edit = SuratPesanan::findOrFail($id);
        $bread = $this->bread('Master', 'Surat Pesanan', 'Table', route('admin.surat-pesanan.index'));
        return view('backend.suratPesanan.detail', compact('bread', 'aparatur', 'vendor', 'edit', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratPesananRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $update = SuratPesanan::findOrFail($id);
            $update->update($request->all());
            DB::commit();
            return redirect()->route('admin.surat-pesanan.edit', $update->id)->with(['status' => 'success', 'message' => 'Ubah Data ' .$update->nama. ' Berhasil']);
            // return response()->json(['status' => 'success', 'message' => 'UBAH DATA ' .$update->nama. ' BERHASIL']);
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
            SuratPesananDetail::where('surat_pesanan_id', $id)
                                ->delete();
            $delete = SuratPesanan::findOrFail($id);
            $delete->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'HAPUS '. $delete->nama. ' BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function cetak($id)
    {
        $sp = SuratPesanan::select(
            'surat_pesanan.*',
            'desa.nama as nama_desa', 'desa.alamat as alamat_desa',
            'vendor.nama_perusahaan as nama_vendor', 'vendor.alamat as alamat_vendor',
            'aparatur.nama as nama_aparatur',
            'users.name as nama_pimpinan_toko', 'kecamatan.nama as kecamatan'
        )
        ->join('desa', 'desa.id', '=', 'surat_pesanan.desa_id')
        ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
        ->join('vendor', 'vendor.id', '=', 'surat_pesanan.vendor_id')
        ->join('users', 'users.vendor_id', '=', 'surat_pesanan.vendor_id')
        ->join('aparatur', 'aparatur.id', '=', 'surat_pesanan.aparatur_id')
        ->where('surat_pesanan.id', $id);

        $akses = $this->aksesRole();
        if($akses['role'] == 'desa') {
            $sp->where('surat_pesanan.desa_id', $akses['desa_id']);
        }

        $sp = $sp->first();

        $sp['tanggal_text'] = sprintf('Pada hari ini %s tanggal %s bulan %s tahun %s', Carbon::parse($sp['tanggal'])->isoFormat('dddd'), ucwords($this->convert(Carbon::parse($sp['tanggal'])->isoFormat('d'))), ucwords(Carbon::parse($sp['tanggal'])->isoFormat('MMMM')), ucwords($this->convert(Carbon::parse($sp['tanggal'])->isoFormat('Y'))));
        $sp['tanggal_lambat_text'] = Carbon::parse($sp['tanggal_lambat'])->isoFormat('d MMMM Y');
        $sp['tanggal'] = Carbon::parse($sp['tanggal'])->isoFormat('d MMMM Y');

        $details = SuratPesananDetail::where('surat_pesanan_id', $id)->get();
        $fileName = sprintf('surat_pesanan_%s.pdf', Str::slug($sp->nama_desa));
        $pdf   = PDF::loadView('backend.suratPesanan.cetak', compact('sp', 'details'));
        return $pdf->setPaper('a4', 'potrait')->download($fileName);
        return view('backend.suratPesanan.cetak', compact('sp', 'details'));
    }
}