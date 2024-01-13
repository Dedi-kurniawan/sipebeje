<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\SuratPesananRequest;
use App\Models\Aparatur;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\SuratPesananDetail;

class SuratPesananDetailController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $create = SuratPesananDetail::create($request->all());
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
            $delete = SuratPesananDetail::findOrFail($id);
            $delete->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'HAPUS '. $delete->nama. ' BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }
}