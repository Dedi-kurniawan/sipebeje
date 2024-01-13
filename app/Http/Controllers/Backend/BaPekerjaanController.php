<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\BaPekerjaanRequest;
use App\Models\Aparatur;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

use App\Models\Satuan;
use App\Models\BaPekerjaan;
use App\Models\BaPekerjaanDetail;
use App\Models\Vendor;
use App\Models\Desa;

class BaPekerjaanController extends Controller
{
    public function index()
    {
        $desa = Desa::select('desa.*');
        $aparatur = Aparatur::select('aparatur.*');

        $akses = $this->aksesRole();
        $desaId = null;

        if($akses['role'] == 'desa') {
            $aparatur->where('desa_id', $akses['desa_id']);
            $desa->where('desa.id', $akses['desa_id']);
            $desaId = $akses['desa_id'];
        }

        $aparatur = $aparatur->get();
        $desa = $desa->get();

        $kepalaDesaId = $aparatur->where('jabatan', 'KEPALA DESA')
                                ->first()
                                ->id ?? null;

        $bread = $this->bread('Master', 'Berita Acara Serah Terima Pekerjaan', 'Table', route('admin.ba-pekerjaan.index'));
        return view('backend.BaPekerjaan.index', compact('bread', 'aparatur', 'kepalaDesaId', 'desa', 'desaId'));
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
    public function store(BaPekerjaanRequest $request)
    {
        DB::beginTransaction();
        try {
            $akses = $this->aksesRole();
            $data  = $request->all();
            $data['desa_id'] = $akses['desa_id'];
            $create = BaPekerjaan::create($data);
            DB::commit();
            return redirect()->route('admin.ba-pekerjaan.edit', $create->id);
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

        $akses = $this->aksesRole();

        if($akses['role'] == 'desa') {
            $aparatur->where('desa_id', $akses['desa_id']);
        }

        $aparatur = $aparatur->get();
        $satuan = Satuan::all();

        $edit = BaPekerjaan::findOrFail($id);
        $bread = $this->bread('Master', 'Berita Acara Serah Terima Pekerjaan', 'Table', route('admin.ba-pekerjaan.index'));
        return view('backend.BaPekerjaan.detail', compact('bread', 'aparatur', 'edit', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BaPekerjaanRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $update = BaPekerjaan::findOrFail($id);
            $update->update($request->all());
            DB::commit();
            return redirect()->route('admin.ba-pekerjaan.edit', $update->id)->with(['status' => 'success', 'message' => 'Ubah Data ' .$update->nama. ' Berhasil']);
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
            BaPekerjaanDetail::where('ba_pekerjaan_id', $id)
                                ->delete();
            $delete = BaPekerjaan::findOrFail($id);
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
        $ba = BaPekerjaan::select(
            'ba_pekerjaan.*',
            'desa.nama as nama_desa',
            'desa.alamat as alamat_desa',
            'aparatur.nama as nama_aparatur',
            'kecamatan.nama as kecamatan',
            'kepala_desa.nama as kepala_desa',
        )
        ->join('desa', 'desa.id', '=', 'ba_pekerjaan.desa_id')
        ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
        ->join('aparatur', 'aparatur.id', '=', 'ba_pekerjaan.aparatur_id')
        ->join('aparatur as kepala_desa', 'kepala_desa.id', '=', 'ba_pekerjaan.kepala_desa_id')
        ->where('ba_pekerjaan.id', $id);

        $akses = $this->aksesRole();
        if($akses['role'] == 'desa') {
            $ba->where('ba_pekerjaan.desa_id', $akses['desa_id']);
        }

        $ba = $ba->first();

        $ba['tanggal_text'] = sprintf('Pada hari ini %s tanggal %s bulan %s tahun %s', Carbon::parse($ba['tanggal'])->isoFormat('dddd'), ucwords($this->convert(Carbon::parse($ba['tanggal'])->isoFormat('d'))), ucwords(Carbon::parse($ba['tanggal'])->isoFormat('MMMM')), ucwords($this->convert(Carbon::parse($ba['tanggal'])->isoFormat('Y'))));
        $ba['tanggal'] = Carbon::parse($ba['tanggal'])->isoFormat('d MMMM Y');

        $details = BaPekerjaanDetail::where('ba_pekerjaan_id', $id)->get();
        $fileName = sprintf('berita_acara_serah_terima_pekerjaan_%s.pdf', Str::slug($ba->nama_desa));
        $pdf = PDF::loadView('backend.BaPekerjaan.cetak', compact('ba', 'details'));
        return $pdf->setPaper('a4', 'potrait')->download($fileName);
    }
}