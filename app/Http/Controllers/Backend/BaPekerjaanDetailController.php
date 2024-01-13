<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\SuratPesananRequest;
use App\Models\Aparatur;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\BaPekerjaanDetail;

class BaPekerjaanDetailController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $create = BaPekerjaanDetail::create($request->all());
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Tambah Data ' .$create->nama. ' Berhasil']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $delete = BaPekerjaanDetail::findOrFail($id);
            $delete->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Hapus '. $delete->nama. ' Berhasil']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }
}