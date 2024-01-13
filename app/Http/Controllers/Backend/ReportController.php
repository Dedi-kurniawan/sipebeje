<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Paket;

use App\Models\Desa;
use App\Models\Vendor;

class ReportController extends Controller
{
    public function index()
    {
        $bread = $this->bread('Laporan', 'Laporan', '', route('admin.paket.index'));
        $desa = Desa::all();
        return view('backend.laporan.index', compact('bread', 'desa'));
    }

    public function cetak(Request $request)
    {
        $paket = Paket::select(
                            'paket.*', 'desa.nama as desa', 'vendor.nama_perusahaan as penyedia', 'aparatur.nama as ketua',
                            'surat_perjanjian.nomor as sp_nomor', 'surat_perjanjian.tanggal as sp_tanggal',
                        )
                        ->join('desa', 'desa.id', '=', 'paket.desa_id')
                        ->join('vendor', 'vendor.id', '=', 'paket.vendor_id')
                        ->join('aparatur', 'aparatur.id', '=', 'paket.aparatur_id')
                        ->join('surat_perjanjian', 'surat_perjanjian.paket_id', '=', 'paket.id')
                        ->whereDate('paket.tanggal_selesai', '>=', $request->dari)
                        ->whereDate('paket.tanggal_selesai', '<=', $request->sampai)
                        ->where('paket.status', 'selesai');

                        if($request->desa) {
                            $paket->where('paket.desa_id', $request->desa);
                        }

        $paket = $paket->get();

        if (count($paket) == 0) {
            return redirect()->back()->with(['status' => 'error', 'action' => 'error', 'title' =>  'Laporan', 'message' => 'Data tidak ditemukan.']);;
        }

        $data = [];
        foreach ($paket as $key => $x) {
            $data[] = [
                'desa' => $x['desa'],
                'penyedia' => $x['penyedia'],
                'nama_paket' => $x['nama'],
                'ketua' => $x['ketua'],
                'hps' => $x['hps'],
                'sp_nomor' => $x['sp_nomor'],
                'sp_tanggal' => Carbon::parse($x['sp_tanggal'])->format('d-m-Y'),
            ];
        }

        $pdf = PDF::loadView('backend.laporan.pengadaan_barang_jasa', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->download('pengadaan_barang_jasa.pdf');
        // return view('backend.laporan.pengadaan_barang_jasa', compact('data'));
    }

    public function penyedia(Request $request)
    {
        $vendor = Vendor::select('vendor.*', 'desa.nama as desa', 'kecamatan.nama as kecamatan', 'kategori.nama as kategori')
                        ->join('desa', 'desa.id', '=', 'vendor.desa_id')
                        ->join('kecamatan', 'kecamatan.id', '=', 'vendor.kecamatan_id')
                        ->leftjoin('kategori', 'kategori.id', '=', 'vendor.kategori_id');

        if($request->desa) {
            $vendor->where('vendor.desa_id', $request->desa);
        }

        $data = $vendor->get();

        $pdf = PDF::loadView('backend.laporan.penyedia', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->download('penyedia.pdf');

        // return view('backend.laporan.penyedia', compact('data'));
    }
}
