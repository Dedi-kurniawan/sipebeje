<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\BaBarangRequest;
use App\Models\Aparatur;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

use App\Models\Satuan;
use App\Models\BaBarang;
use App\Models\BaBarangDetail;
use App\Models\Vendor;
use App\Models\Desa;
use App\Models\HpsBaNego;
use App\Models\Paket;

class BaBarangController extends Controller
{
    public function index()
    {
        $desa = Desa::select('desa.*');
        $aparatur = Aparatur::select('aparatur.*');

        $paket = Paket::select('paket.*')
                        ->join('desa', 'desa.id', '=', 'paket.desa_id');

        $akses = $this->aksesRole();
        $desaId = null;

        if($akses['role'] == 'desa') {
            $aparatur->where('desa_id', $akses['desa_id']);
            $desa->where('id', $akses['desa_id']);
            $desaId = $akses['desa_id'];

            $paket->where('paket.desa_id', $akses['desa_id']);

            $paketIds = BaBarang::select('ba_barang.*')
                                ->join('paket', 'paket.id', '=', 'ba_barang.paket_id')
                                ->where('paket.desa_id', $akses['desa_id'])
                                ->pluck('paket_id');

            $paket->whereNotIn('paket.id', $paketIds);
        }

        $aparatur = $aparatur->get();
        $desa = $desa->get();
        $paket = $paket->get();

        $bread = $this->bread('Master', 'Berita Acara Serah Terima Barang', 'Table', route('admin.ba-barang.index'));
        return view('backend.baBarang.index', compact('bread', 'aparatur', 'desa', 'desaId', 'paket'));
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
    public function store(BaBarangRequest $request)
    {
        DB::beginTransaction();
        try {
            $data  = $request->all();
            BaBarang::create($data);
            DB::commit();
            return redirect()->route('admin.ba-barang.index');
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

        $edit = BaBarang::findOrFail($id);
        $bread = $this->bread('Master', 'Berita Acara Serah Terima Barang', 'Table', route('admin.ba-barang.index'));
        return view('backend.BaBarang.detail', compact('bread', 'aparatur', 'vendor', 'edit', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BaBarangRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $update = BaBarang::findOrFail($id);
            $update->update($request->all());
            DB::commit();
            return redirect()->route('admin.ba-barang.edit', $update->id)->with(['status' => 'success', 'message' => 'Ubah Data ' .$update->nama. ' Berhasil']);
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
            BaBarangDetail::where('ba_barang_id', $id)
                                ->delete();
            $delete = BaBarang::findOrFail($id);
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
        $ba = BaBarang::select(
            'ba_barang.*',
            'paket.id as paket_id',
            'desa.nama as nama_desa',
            'desa.alamat as alamat_desa',
            'pihak_1.nama as pihak_1',
            'pihak_2.nama as pihak_2',
            'kecamatan.nama as kecamatan'
        )
        ->join('paket', 'paket.id', '=', 'ba_barang.paket_id')
        ->join('aparatur as pihak_1', 'pihak_1.id', '=', 'paket.aparatur_id')
        ->join('desa', 'desa.id', '=', 'paket.desa_id')
        ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
        ->join('aparatur as pihak_2', 'pihak_2.id', '=', 'ba_barang.aparatur_id')
        ->where('ba_barang.id', $id);

        $akses = $this->aksesRole();
        if($akses['role'] == 'desa') {
            $ba->where('paket.desa_id', $akses['desa_id']);
        }

        $ba = $ba->first();

        $ba['tanggal_text'] = sprintf('Pada hari ini %s tanggal %s bulan %s tahun %s', Carbon::parse($ba['tanggal'])->isoFormat('dddd'), ucwords($this->convert(Carbon::parse($ba['tanggal'])->isoFormat('D'))), ucwords(Carbon::parse($ba['tanggal'])->isoFormat('MMMM')), ucwords($this->convert(Carbon::parse($ba['tanggal'])->isoFormat('Y'))));
        $ba['tanggal'] = Carbon::parse($ba['tanggal'])->isoFormat('D MMMM Y');

        $details = HpsBaNego::where('paket_id', $ba->paket_id)->get();
        $fileName = sprintf('berita_acara_serah_terima_barang_%s.pdf', Str::slug($ba->nama_desa));
        $pdf = PDF::loadView('backend.baBarang.cetak', compact('ba', 'details'));
        return $pdf->setPaper('a4', 'potrait')->download($fileName);
        return view('backend.baBarang.cetak', compact('sp', 'details'));
    }
}