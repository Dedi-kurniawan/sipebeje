<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\DataTable\BaseController as Controller;
use App\Models\Paket;
use Yajra\DataTables\Facades\DataTables;
use App\Models\UndanganVendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function paket(Request $request)
    {
        $akses = $this->aksesRole();
        $data = Paket::OfNama($request->search)->OfStatus($request->status)->whereHas('undanganVendor', function ($query) use ($akses) {
            return $query->where('vendor_id', $akses['vendor_id'])->where('status', '!=', '0');
        })->with(['vendor', 'desa', 'aparatur'])->orderby('created_at', 'desc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('nama_format', function ($data) {
            $route = route('admin.paket-vendor.show', $data->id);
            return "<a href='$route'>" .$data->NamaFormat . "</a><br>" . $data->StatusFormatAt . " " . $data->TanggalSelesaiAt;
        })
        ->addColumn('hps_format', function ($data) {
            return "Rp. " . $this->rupiahFormat($data->hps);
        })
        ->addColumn('aparatur_format', function ($data) {
            $jabatan = $data->aparatur->jabatan;
            return $data->aparatur->nama. "<br> <span class='badge bg-sm bg-success'>$jabatan</span>";
        })
        ->addColumn('vendor_format', function ($data) {
            return $data->vendor_id == NULL ? "<span class='badge bg-sm bg-info'>Belum di Konfirmasi</span>" : $data->vendor->nama_perusahaan;
        })
        ->rawColumns(['action', 'nama_format', 'vendor_format', 'aparatur_format'])
        ->toJson();
    }


    public function undangan(Request $request)
    {
        $akses = $this->aksesRole();
        $data = UndanganVendor::where('vendor_id', $akses['vendor_id'])
                ->OfStatus($request->status)->with(['paket', 'vendor', 'paket.desa'])->orderby('created_at', 'asc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_format', function ($data) {
                $route = route('admin.undangan.paket.show', $data->id);
                $nama = $data->paket->NamaFormat;
                return "<a href='$route'>$nama</a>";
            })
            ->addColumn('hps_format', function ($data) {
                return "Rp. " . $this->rupiahFormat($data->paket->hps);
            })
            ->addColumn('status_format', function ($data) {
                if ($data->status == "2") {
                    return "<span class='badge bg-sm bg-success'>Ikut</span>";
                }elseif ($data->status == "1") {
                    return "<span class='badge bg-sm bg-danger'>Tidak Ikut</span>";
                }else{
                    return "<span class='badge bg-sm bg-info'>Belum di Konfirmasi</span>";
                }  
            })
            ->addColumn('tanggal_selesai_format', function ($data) {
                return $data->paket->TanggalSelesaiAt;
            })
            
            ->addColumn('action', function ($data) {
                $route = route('admin.undangan.paket.konfirmasi', $data->paket->id);
                return "<a href='$route' class='btn btn-sm btn-outline-danger'><i class='fa fa-bell'></i> Konfirmasi</a>";
            })
            ->rawColumns(['action', 'status_format', 'nama_format', 'tanggal_selesai_format'])
            ->toJson();
    }
}
