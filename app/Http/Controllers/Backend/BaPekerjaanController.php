<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\BaPekerjaanRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

use App\Models\Satuan;
use App\Models\BaPekerjaan;
use App\Models\BaPekerjaanDetail;
use App\Models\Paket;
use App\Models\Desa;
use App\Models\HpsBaNego;
use App\Models\Aparatur;

class BaPekerjaanController extends Controller
{
    public function index()
    {
        $desa = Desa::select('desa.*');
        $paket = Paket::select('paket.*')
                        ->join('desa', 'desa.id', '=', 'paket.desa_id');

        $akses = $this->aksesRole();
        $desaId = null;

        if($akses['role'] == 'desa') {
            $desa->where('desa.id', $akses['desa_id']);
            $desaId = $akses['desa_id'];

            $paket->where('paket.desa_id', $akses['desa_id']);

            $paketIds = BaPekerjaan::select('ba_pekerjaan.*')
                                ->join('paket', 'paket.id', '=', 'ba_pekerjaan.paket_id')
                                ->where('paket.desa_id', $akses['desa_id'])
                                ->pluck('paket_id');

            $paket->whereNotIn('paket.id', $paketIds);
        }

        $desa = $desa->get();
        $paket = $paket->get();

        $bread = $this->bread('Master', 'Berita Acara Serah Terima Pekerjaan', 'Table', route('admin.ba-pekerjaan.index'));
        return view('backend.baPekerjaan.index', compact('bread', 'desa', 'desaId', 'paket'));
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
            $data  = $request->all();
            $create = BaPekerjaan::create($data);
            DB::commit();
            return redirect()->route('admin.ba-pekerjaan.index');
        } catch (QueryException $qe) {
            DB::rollback();
            return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' =>  'TAMBAH PAKET', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
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
        $akses = $this->aksesRole();
        $edit = BaPekerjaan::findOrFail($id);
        $details = HpsBaNego::where('paket_id', $edit->paket_id)->get();
        $bread = $this->bread('Master', 'Berita Acara Serah Terima Pekerjaan', 'Table', route('admin.ba-pekerjaan.index'));
        return view('backend.baPekerjaan.detail', compact('bread', 'edit', 'details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $details = $request->details;

            foreach ($details as $key => $detail) {
                $row = HpsBaNego::find($key);
                if(isset($detail['checklist'])) {
                    $row->checklist = $detail['checklist'];
                    $row->checklist_keterangan = $detail['keterangan'];
                    $row->save();
                }
            }

            DB::commit();
            return redirect()->route('admin.ba-pekerjaan.edit', $id)->with(['status' => 'success', 'message' => 'Ubah Data Berhasil']);
            // return response()->json(['status' => 'success', 'message' => 'UBAH DATA ' .$update->nama. ' BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->back()->with(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
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
            'paket.desa_id as desa_id',
        )
        ->join('paket', 'paket.id', '=', 'ba_pekerjaan.paket_id')
        ->join('desa', 'desa.id', '=', 'paket.desa_id')
        ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
        ->join('aparatur', 'aparatur.id', '=', 'paket.aparatur_id')
        ->where('ba_pekerjaan.id', $id);

        $akses = $this->aksesRole();
        if($akses['role'] == 'desa') {
            $ba->where('paket.desa_id', $akses['desa_id']);
        }

        $ba = $ba->firstOrFail();

        $aparatur = Aparatur::where('status', '1')
                    ->where('desa_id', $ba->desa_id)
                    ->where('jabatan', 'KEPALA DESA')
                    ->first();

        $ba['tanggal_text'] = sprintf('Pada hari ini %s tanggal %s bulan %s tahun %s', Carbon::parse($ba['tanggal'])->isoFormat('dddd'), ucwords($this->convert(Carbon::parse($ba['tanggal'])->isoFormat('D'))), ucwords(Carbon::parse($ba['tanggal'])->isoFormat('MMMM')), ucwords($this->convert(Carbon::parse($ba['tanggal'])->isoFormat('Y'))));
        $ba['tanggal'] = Carbon::parse($ba['tanggal'])->isoFormat('D MMMM Y');
        $ba['kepala_desa'] = $aparatur ? $aparatur->nama : null;

        $details = HpsBaNego::where('paket_id', $ba->paket_id)->get();
        $fileName = sprintf('berita_acara_serah_terima_pekerjaan_%s.pdf', Str::slug($ba->nama_desa));
        $pdf = PDF::loadView('backend.baPekerjaan.cetak', compact('ba', 'details'));
        return $pdf->setPaper('a4', 'potrait')->download($fileName);
    }
}