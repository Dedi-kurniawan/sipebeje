<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\DataTable\BaseController as Controller;
use App\Models\Aparatur;
use App\Models\Desa;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function desa(Request $request)
    {
        $data = Desa::OfNama($request->nama)->OfKecamatanId($request->kecamatan_id)->with('kecamatan')->orderby('nama', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('kontak', function($data){
            $telepon = $data->telepon == NULL ? "-" : $data->telepon;
            $email   = $data->email == NULL ? "-" : $data->email;
            return $telepon." / ".$email;
        })
        ->addColumn('action',function($data){
            $edit = route('admin.kecamatan.edit', $data->id);
            return view('layouts.backend.partials.action.default',[
                'edit'  => $edit,
                'id'    => $data->id,
                'name'  => $data->nama,
            ]);
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function kecamatan()
    {
        $data = Kecamatan::orderby('nama', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action',function($data){
            $edit = route('admin.kecamatan.edit', $data->id);
            return view('layouts.backend.partials.action.default',[
                'edit'  => $edit,
                'id'    => $data->id,
                'name'  => $data->nama,
            ]);
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function kategori()
    {
        $data = Kategori::orderby('nama', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('status_format', function($data){
            return $data->StatusFormatAt;
        })
        ->addColumn('action',function($data){
            $edit = route('admin.kecamatan.edit', $data->id);
            return view('layouts.backend.partials.action.default',[
                'edit'  => $edit,
                'id'    => $data->id,
                'name'  => $data->nama,
            ]);
        })
        ->rawColumns(['action', 'status_format'])
        ->toJson();
    }

    public function operator(Request $request)
    {
        $data = User::OfRole('desa')->with('desa')->orderby('name', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('status_format', function($data){
            return $data->StatusFormatAt;
        })
        ->addColumn('action',function($data){
            $edit = route('admin.operator.edit', $data->id);
            return view('layouts.backend.partials.action.default',[
                'edit'  => $edit,
                'id'    => $data->id,
                'name'  => $data->name,
            ]);
        })
        ->rawColumns(['action', 'status_format'])
        ->toJson();
    }

    public function aparatur(Request $request)
    {
        $data = Aparatur::OfKecamatan($request->kecamatan_id)
                ->OfDesa($request->desa_id)
                ->OfNama($request->nama)
                ->with(['kecamatan', 'desa'])->orderby('nama', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('status_format', function($data){
            return $data->StatusFormatAt;
        })
        ->addColumn('action',function($data){
            $edit = route('admin.operator.edit', $data->id);
            return view('layouts.backend.partials.action.default',[
                'edit'  => $edit,
                'id'    => $data->id,
                'name'  => $data->nama,
            ]);
        })
        ->rawColumns(['action', 'status_format'])
        ->toJson();
    }

}
