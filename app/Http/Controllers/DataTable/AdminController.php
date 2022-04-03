<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\DataTable\BaseController as Controller;
use App\Models\Paket;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function paket(Request $request)
    {
        $data = Paket::OfDesaId($request->desa_id)->OfStatus($request->status)
                ->OfNama($request->nama)->with(['desa', 'aparatur'])
                ->orderby('created_at', 'desc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('hps_format', function ($data) {
                return "Rp. " . $this->rupiahFormat($data->hps);
            })
            ->addColumn('nama_format', function ($data) {
                return $data->NamaFormat . "<br>" . $data->StatusFormatAt . " " . $data->TanggalSelesaiAt;
            })
            ->addColumn('penanggung_jawab', function ($data) {
                return $data->aparatur->nama . " | " . $data->aparatur->jabatan;
            })
            ->addColumn('cetak', function ($data) {
                return view('layouts.backend.partials.action.cetak', [
                    'id' => $data->id,
                ]);
            })
            ->addColumn('action', function ($data) {
                return "<button id='deleteData' data-id='$data->id' data-name='$data->nama' class='btn btn-sm btn-outline-danger'><i class='fa fa-trash'></i> Hapus</button>";
            })
            ->rawColumns(['action', 'nama_format'])
            ->toJson();
    }
}
