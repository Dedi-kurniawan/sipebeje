<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\DataTable\BaseController as Controller;
use App\Models\Paket;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\SuratPesanan;
use App\Models\SuratPesananDetail;
use App\Models\BaBarang;
use App\Models\BaBarangDetail;
use App\Models\BaPekerjaan;
use App\Models\BaPekerjaanDetail;

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

    public function suratPesanan(Request $request)
    {
        $data = SuratPesanan::select(
            'surat_pesanan.*',
            'desa.nama as nama_desa', 'desa.alamat as alamat_desa',
            'vendor.nama_perusahaan as nama_vendor', 'vendor.alamat as alamat_vendor',
            'aparatur.nama as nama_aparatur',
            'paket.nama as nama_paket'
        )
        ->join('paket', 'paket.id', '=', 'surat_pesanan.paket_id')
        ->join('desa', 'desa.id', '=', 'paket.desa_id')
        ->join('vendor', 'vendor.id', '=', 'paket.vendor_id')
        ->join('aparatur', 'aparatur.id', '=', 'paket.aparatur_id');

        $akses = $this->aksesRole();
        if($akses['role'] == 'desa') {
            $data->where('paket.desa_id', $akses['desa_id']);
        }

        if($request->desa_id) {
            $data->where('paket.desa_id', $request->desa_id);
        }

        if($request->search) {
            $keyword = $request->search;
            $data->where(function($query) use ($keyword) {
                $pattern = '%' . $keyword . '%';
                $query->orWhere('surat_pesanan.nomor_surat', 'like', $pattern);
            });
        }

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('tanggal', function ($data) {
            return Carbon::parse($data->tanggal)->format('d-m-Y');
        })
        ->addColumn('tanggal_lambat', function ($data) {
            return Carbon::parse($data->tanggal_lambat)->format('d-m-Y');
        })
        ->addColumn('action', function ($data) use ($akses) {
            $cetak = route('admin.surat-pesanan.cetak', $data->id);
            $action = "<a href={$cetak} data-id='$data->id' data-name='$data->nama_paket' class='btn btn-sm btn-outline-info'>
                        <i class='fa fa-print'></i> Cetak
                    </a> ";

            $action .= "<button id='deleteData' data-id='$data->id' data-name='$data->nama_paket' class='btn btn-sm btn-outline-danger'>
                            <i class='fa fa-trash'></i> Hapus
                            </button>";

            return $action;
        })
        ->rawColumns(['action'])
        ->toJson();
        // $data = SuratPesanan::select(
        //                         'surat_pesanan.*',
        //                         'desa.nama as nama_desa', 'desa.alamat as alamat_desa',
        //                         'vendor.nama_perusahaan as nama_vendor', 'vendor.alamat as alamat_vendor',
        //                         'aparatur.nama as nama_aparatur'
        //                     )
        //                     ->join('desa', 'desa.id', '=', 'surat_pesanan.desa_id')
        //                     ->join('vendor', 'vendor.id', '=', 'surat_pesanan.vendor_id')
        //                     ->join('aparatur', 'aparatur.id', '=', 'surat_pesanan.aparatur_id');

        // $akses = $this->aksesRole();
        // if($akses['role'] == 'desa') {
        //     $data->where('surat_pesanan.desa_id', $akses['desa_id']);
        // }

        // if($request->desa_id) {
        //     $data->where('surat_pesanan.desa_id', $request->desa_id);
        // }

        // if($request->search) {
        //     $keyword = $request->search;
        //     $data->where(function($query) use ($keyword) {
        //         $pattern = '%' . $keyword . '%';
        //         $query->orWhere('surat_pesanan.nomor_surat', 'like', $pattern);
        //     });
        // }

        // return DataTables::of($data)
        //     ->addIndexColumn()
        //     ->addColumn('tanggal', function ($data) {
        //         return Carbon::parse($data->tanggal)->format('d-m-Y');
        //     })
        //     ->addColumn('tanggal_lambat', function ($data) {
        //         return Carbon::parse($data->tanggal_lambat)->format('d-m-Y');
        //     })
        //     ->addColumn('action', function ($data) use ($akses) {
        //         $route = route('admin.surat-pesanan.edit', $data->id);
        //         $cetak = route('admin.surat-pesanan.cetak', $data->id);
        //         $action = "<a href={$cetak} data-id='$data->id' data-name='$data->nama_desa' class='btn btn-sm btn-outline-info'>
        //                         <i class='fa fa-print'></i> Cetak
        //                     </a>";

        //         if($akses['role'] == 'desa') {
        //             $action .= "<a href={$route} data-id='$data->id' data-name='$data->nama_desa' class='btn btn-sm btn-outline-success'>
        //                             <i class='fa fa-edit'></i> Ubah
        //                         </a>";
        //             $action .= "<button id='deleteData' data-id='$data->id' data-name='$data->nama_desa' class='btn btn-sm btn-outline-danger'>
        //                             <i class='fa fa-trash'></i> Hapus
        //                         </button>";
        //         }

        //         return $action;
        //     })
        //     ->rawColumns(['action'])
        //     ->toJson();
    }

    public function suratPesananDetail(Request $request)
    {
        $data = SuratPesananDetail::where('surat_pesanan_id', $request->surat_pesanan_id);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('total', function ($data) {
                return number_format($data->qty * $data->sp, 2);
            })
            ->addColumn('sp', function ($data) {
                return number_format($data->sp, 2);
            })
            ->addColumn('action', function ($data) {
                return "<button id='deleteData' data-id='$data->id' data-name='$data->nama' class='btn btn-sm btn-outline-danger'><i class='fa fa-trash'></i> Hapus</button>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function baBarang(Request $request)
    {
        $data = BaBarang::select(
                            'ba_barang.*',
                            'desa.nama as nama_desa',
                            'desa.alamat as alamat_desa',
                            'pihak_1.nama as pihak_1',
                            'pihak_2.nama as pihak_2',
                            'paket.nama as nama_paket'
                        )
                        ->join('paket', 'paket.id', '=', 'ba_barang.paket_id')
                        ->join('aparatur as pihak_1', 'pihak_1.id', '=', 'paket.aparatur_id')
                        ->join('desa', 'desa.id', '=', 'paket.desa_id')
                        ->join('aparatur as pihak_2', 'pihak_2.id', '=', 'ba_barang.aparatur_id');

        $akses = $this->aksesRole();
        if($akses['role'] == 'desa') {
            $data->where('paket.desa_id', $akses['desa_id']);
        }

        if($request->desa_id) {
            $data->where('paket.desa_id', $request->desa_id);
        }

        if($request->search) {
            $keyword = $request->search;
            $data->where(function($query) use ($keyword) {
                $pattern = '%' . $keyword . '%';
                $query->orWhere('ba_barang.nomor_surat', 'like', $pattern);
            });
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($data) {
                return Carbon::parse($data->tanggal)->format('d-m-Y');
            })
            ->addColumn('action', function ($data) use ($akses) {
                $cetak = route('admin.ba-barang.cetak', $data->id);
                $action = "<a href={$cetak} data-id='$data->id' data-name='$data->nama_desa' class='btn btn-sm btn-outline-info'>
                                <i class='fa fa-print'></i> Cetak
                            </a> ";

                if($akses['role'] == 'desa') {
                    $action .= "<button id='deleteData' data-id='$data->id' data-name='$data->nama_desa' class='btn btn-sm btn-outline-danger'>
                                    <i class='fa fa-trash'></i> Hapus
                                </button>";
                }

                return $action;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function baBarangDetail(Request $request)
    {
        $data = BaBarangDetail::where('ba_barang_id', $request->ba_barang_id);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('total', function ($data) {
                return number_format($data->qty * $data->harga_satuan, 2);
            })
            ->addColumn('harga_satuan', function ($data) {
                return number_format($data->harga_satuan, 2);
            })
            ->addColumn('action', function ($data) {
                return "<button id='deleteData' data-id='$data->id' data-name='$data->nama' class='btn btn-sm btn-outline-danger'><i class='fa fa-trash'></i> Hapus</button>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function baPekerjaan(Request $request)
    {
        $data = BaPekerjaan::select(
                                'ba_pekerjaan.*',
                                'desa.nama as nama_desa',
                                'desa.alamat as alamat_desa',
                                'aparatur.nama as ketua_tpk',
                                'paket.nama as nama_paket'
                            )
                            ->join('paket', 'paket.id', '=', 'ba_pekerjaan.paket_id')
                            ->join('aparatur', 'aparatur.id', '=', 'paket.aparatur_id')
                            ->join('desa', 'desa.id', '=', 'paket.desa_id');

        $akses = $this->aksesRole();
        if($akses['role'] == 'desa') {
            $data->where('paket.desa_id', $akses['desa_id']);
        }

        if($request->desa_id) {
            $data->where('paket.desa_id', $request->desa_id);
        }

        if($request->search) {
            $keyword = $request->search;
            $data->where(function($query) use ($keyword) {
                $pattern = '%' . $keyword . '%';
                $query->orWhere('ba_pekerjaan.nomor_surat', 'like', $pattern);
            });
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($data) {
                return Carbon::parse($data->tanggal)->format('d-m-Y');
            })
            ->addColumn('action', function ($data) use ($akses) {
                $route = route('admin.ba-pekerjaan.edit', $data->id);
                $cetak = route('admin.ba-pekerjaan.cetak', $data->id);
                $action = "<a href={$cetak} data-id='$data->id' data-name='$data->nama_desa' class='btn btn-sm btn-outline-info'>
                                <i class='fa fa-print'></i> Cetak
                            </a>";

                if($akses['role'] == 'desa') {
                    $action .= "<a href={$route} data-id='$data->id' data-name='$data->nama_desa' class='btn btn-sm btn-outline-success'>
                                    <i class='fa fa-edit'></i> Ubah
                                </a>";
                    $action .= "<button id='deleteData' data-id='$data->id' data-name='$data->nama_desa' class='btn btn-sm btn-outline-danger'>
                                    <i class='fa fa-trash'></i> Hapus
                                </button>";
                }

                return $action;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function baPekerjaanDetail(Request $request)
    {
        $data = baPekerjaanDetail::where('ba_pekerjaan_id', $request->ba_pekerjaan_id);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return "<button id='deleteData' data-id='$data->id' data-name='$data->nama' class='btn btn-sm btn-outline-danger'><i class='fa fa-trash'></i> Hapus</button>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
