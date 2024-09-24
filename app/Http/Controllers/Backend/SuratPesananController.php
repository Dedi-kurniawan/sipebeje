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
use App\Models\Paket;
use App\Models\HpsBaNego;

class SuratPesananController extends Controller
{
    public function index()
    {
        $paket = Paket::select('paket.*')
                        ->join('desa', 'desa.id', '=', 'paket.desa_id');

        $desa = Desa::select('desa.*');

        $akses = $this->aksesRole();
        $desaId = null;
        if($akses['role'] == 'desa') {
            $paket->where('paket.desa_id', $akses['desa_id']);

            $paketIds = SuratPesanan::select('surat_pesanan.*')
                                ->join('paket', 'paket.id', '=', 'surat_pesanan.paket_id')
                                ->where('paket.desa_id', $akses['desa_id'])
                                ->pluck('paket_id');

            $paket->whereNotIn('paket.id', $paketIds);
            $desa->where('id', $akses['desa_id']);
            $desaId = $akses['desa_id'];
        }

        $paket->where('paket.status', 'selesai');
        $paket = $paket->get();
        $desa = $desa->get();

        $bread = $this->bread('Master', 'Surat Pesanan', 'Table', route('admin.surat-pesanan.index'));
        return view('backend.suratPesanan.index', compact('bread', 'paket', 'desa', 'desaId'));
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
            $data  = $request->all();
            $create = SuratPesanan::create($data);
            DB::commit();
            return redirect()->route('admin.surat-pesanan.index');
            // return response()->json(['status' => 'success', 'message' => 'TAMBAH DATA ' .$create->nama. ' BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
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
        $edit = SuratPesanan::findOrFail($id);
        $bread = $this->bread('Master', 'Surat Pesanan', 'Table', route('admin.surat-pesanan.index'));
        return view('backend.suratPesanan.detail', compact('bread', 'edit'));
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
            'paket.id as paket_id',
            'desa.nama as nama_desa', 'desa.alamat as alamat_desa',
            'vendor.nama_perusahaan as nama_vendor', 'vendor.alamat as alamat_vendor',
            'aparatur.nama as nama_aparatur',
            'users.name as nama_pimpinan_toko', 'kecamatan.nama as kecamatan'
        )
        ->join('paket', 'paket.id', '=', 'surat_pesanan.paket_id')
        ->join('desa', 'desa.id', '=', 'paket.desa_id')
        ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
        ->join('vendor', 'vendor.id', '=', 'paket.vendor_id')
        ->join('users', 'users.vendor_id', '=', 'paket.vendor_id')
        ->join('aparatur', 'aparatur.id', '=', 'paket.aparatur_id')
        ->where('surat_pesanan.id', $id);

        $akses = $this->aksesRole();
        if($akses['role'] == 'desa') {
            $sp->where('paket.desa_id', $akses['desa_id']);
        }

        $sp = $sp->first();

        $sp['tanggal_text'] = ' Pada hari ini ' .Carbon::parse($sp['tanggal'])->isoFormat('dddd'). ' tanggal ' .Carbon::parse($sp['tanggal'])->isoFormat('D'). ' bulan ' .Carbon::parse($sp['tanggal'])->isoFormat('MMMM'). ' tahun ' .Carbon::parse($sp['tanggal'])->isoFormat('Y');  
        $sp['tanggal_lambat_text'] = Carbon::parse($sp['tanggal_lambat'])->isoFormat('D MMMM Y');
        $sp['tanggal'] = Carbon::parse($sp['tanggal'])->isoFormat('D MMMM Y');

        $details = HpsBaNego::where('paket_id', $sp->paket_id)->get();
        $fileName = sprintf('surat_pesanan_%s.pdf', Str::slug($sp->nama_desa));
        $pdf   = PDF::loadView('backend.suratPesanan.cetak', compact('sp', 'details'));
        return $pdf->setPaper('a4', 'potrait')->stream($fileName);
        return view('backend.suratPesanan.cetak', compact('sp', 'details'));
    }
}