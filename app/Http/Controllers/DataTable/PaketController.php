<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\DataTable\BaseController as Controller;
use App\Models\HasilEvaluasiPenawaran;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\UndanganMaterial;
use App\Models\UndanganVendor;
use App\Models\Hps;
use App\Models\Paket;
use App\Models\HpsBaNego;

class PaketController extends Controller
{
    public function paket(Request $request)
    {
        $akses = $this->aksesRole();
        $data = Paket::OfDesaId($akses['desa_id'])->OfStatus($request->status)
                ->OfNama($request->search)->with(['desa', 'aparatur'])->orderby('created_at', 'asc');
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
            ->addColumn('action', function ($data) {
                $edit = route('admin.paket.edit', $data->id);
                $show = route('admin.paket.show', $data->id);
                $step = route('admin.evaluasi-penawaran.edit', $data->id);
                return view('layouts.backend.partials.action.paket', [
                    'step'  => $step,
                    'show'  => $show,
                    'edit'  => $edit,
                    'id'    => $data->id,
                    'name'  => $data->nama,
                ]);
            })
            ->addColumn('cetak', function ($data) {
                return view('layouts.backend.partials.action.cetak', [
                    'id' => $data->id,
                ]);
            })
            ->addColumn('step_one', function ($data) {
                return "<div class='btn-group-vertical mb-2'>" . $data->HpsFieldIcon . " " . $data->AkkFieldIcon . " " . $data->UndanganFieldIcon . "</div>";
            })
            ->addColumn('step_two', function ($data) {
                return "<div class='btn-group-vertical mb-2'>" . $data->EvaluasiFieldIcon ." ". $data->HasilEvaluasiFieldIcon ." ". $data->NegoHargaFieldIcon ." ". $data->PerjanjianFieldIcon ."</div>";
            })
            ->rawColumns(['action', 'nama_format', 'step_one', 'step_two'])
            ->toJson();
    }

    public function hps(Request $request)
    {
        $data = Hps::OfPaketId($request->paket_id)->orderby('created_at', 'asc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('harga_satuan_format', function ($data) {
                return $this->rupiahFormat($data->harga_satuan);
            })
            ->addColumn('jumlah_format', function ($data) {
                return $this->rupiahFormat($data->jumlah);
            })
            ->addColumn('harga_pajak_format', function ($data) {
                return $this->rupiahFormat($data->jumlah + $data->harga_pajak);
            })
            ->addColumn('action', function ($data) {
                return "<button id='deleteData' data-id='$data->id' data-name='$data->uraian' class='btn btn-sm btn-outline-danger'><i class='fa fa-trash'></i> Hapus</button>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function hpsBaNego(Request $request)
    {
        $data = HpsBaNego::OfPaketId($request->paket_id)->orderby('created_at', 'asc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('harga_satuan_format', function ($data) {
                return $this->rupiahFormat($data->harga_satuan);
            })
            ->addColumn('jumlah_format', function ($data) {
                return $this->rupiahFormat($data->jumlah);
            })
            ->addColumn('harga_pajak_format', function ($data) {
                return $this->rupiahFormat($data->jumlah + $data->harga_pajak);
            })
            ->addColumn('action', function ($data) {
                return "<button type='button' id='deleteData' data-id='$data->id' data-name='$data->uraian' class='btn btn-sm btn-outline-danger'><i class='fa fa-trash'></i> Hapus</button>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function undanganVendor(Request $request)
    {
        $data = UndanganVendor::where('undangan_id', $request->undangan_id)
            ->with(['vendor', 'vendor.desa'])
            ->orderby('created_at', 'asc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status_format', function ($data) {
                if ($data->status == "2") {
                    return "<span class='badge bg-sm bg-success'>Ikut</span>";
                }elseif ($data->status == "1") {
                    return "<span class='badge bg-sm bg-danger'>Tidak Ikut</span>";
                }else{
                    return "<span class='badge bg-sm bg-info'>Belum di Konfirmasi</span>";
                }  
            })
            ->addColumn('action', function ($data) {
                $nama = $data->vendor->nama_perusahaan;
                return "<button id='deleteVendor' data-id='$data->id' data-name='$nama' class='btn btn-sm btn-outline-danger'><i class='fa fa-trash'></i> Hapus</button>";
            })
            ->rawColumns(['action', 'status_format'])
            ->toJson();
    }

    public function undanganMaterial(Request $request)
    {
        $data = UndanganMaterial::where('undangan_id', $request->undangan_id)
            ->orderby('created_at', 'asc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('harga_satuan_format', function ($data) {
                return $this->rupiahFormat($data->harga_satuan);
            })
            ->addColumn('action', function ($data) {
                return "<button id='undanganMaterial' data-id='$data->id' data-name='$data->uraian' class='btn btn-sm btn-outline-danger'><i class='fa fa-trash'></i> Hapus</button>";
            })
            ->rawColumns(['action'])
            ->with('total_harga_satuan', function() use ($data) {
                return $this->rupiahFormat($data->sum('harga_satuan'));
            })
            ->toJson();
    }

    public function hasilEvaluasiPenawaran(Request $request)
    {
        $data  = HasilEvaluasiPenawaran::where('paket_id', $request->paket_id)->with('vendor')->orderby('created_at', 'asc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $name = $data->vendor->nama_perusahaan;
                return "<button id='deleteData' data-id='$data->id' data-name='$name' class='btn btn-sm btn-outline-danger'><i class='fa fa-trash'></i> Hapus</button>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function cetakUndangan(Request $request)
    {
        $data = UndanganVendor::where('paket_id', $request->paket_id)
            ->with(['vendor', 'vendor.desa'])
            ->orderby('created_at', 'asc');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status_format', function ($data) {
                if ($data->status == "2") {
                    return "<span class='badge bg-sm bg-success'>Ikut</span>";
                }elseif ($data->status == "1") {
                    return "<span class='badge bg-sm bg-danger'>Tidak Ikut</span>";
                }else{
                    return "<span class='badge bg-sm bg-info'>Belum di Konfirmasi</span>";
                }  
            })
            ->addColumn('action', function ($data) {
                return view('layouts.backend.partials.action.print_undangan', [
                    'paket_id'    => $data->paket_id,
                    'undangan_id' => $data->undangan_id,
                    'vendor_id'   => $data->vendor_id,
                ]);
            })
            ->rawColumns(['action', 'status_format'])
            ->toJson();
    }
}
