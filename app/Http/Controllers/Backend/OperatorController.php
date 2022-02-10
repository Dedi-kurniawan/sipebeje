<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Http\Requests\OperatorRequest;
use App\Models\Desa;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bread = $this->bread('AUTH', 'Operator', 'Table', route('admin.operator.index'));
        $desa = Desa::with('kecamatan')->select('id', 'nama', 'kecamatan_id')->get();
        return view('backend.operator.index', compact('bread', 'desa'));
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

    public function store(OperatorRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('password');            
            $data['desa_id'] = $request->desa_id;          
            $data['confirmed'] = '1';
            $data['status'] = '1';
            $data['full_field'] = '1';
            $data['role'] = 'desa';
            $data['confirm_url'] = $request->email.'_'.Str::random(20).'-'.date('Ymdhis');
            $data['url_name'] = $request->email.'_'.Str::random(20).'-'.date('Ymdhis');
            if ($request->password == NULL) {
                $data['password'] = Hash::make('12345678');  
            }else {
                $data['password'] = Hash::make($request->password);  
            }
            $create = User::create($data);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'TAMBAH DATA ' .$create->nama. ' BERHASIL']);
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
        $edit = User::findOrFail($id);
        return response()->json(['status' => 'success', 'edit' => $edit]);
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
            $update = User::findOrFail($id);
            $data = $request->except('password');            
            if ($request->password != NULL) {
                $data['password'] = Hash::make($request->password);  
            }
            $update->update($data); 
            DB::commit();
            return response()->json(['status' => 'info', 'message' => 'UBAH DATA ' .$update->name. ' BERHASIL']);
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
            $delete = User::findOrFail($id);
            $delete->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'HAPUS '. $delete->name. ' BERHASIL']);
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }

    public function status($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $status = User::findOrFail($id);
            $update = $request->status == "1" ? "0" : "1";
            $status->update([
                'status' => $update,
            ]);        
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'UBAH STATUS '. $status->name. ' BERHASIL']);  
        } catch (QueryException $qe) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalah Pada Server, Mohon Di Ulangi']);
        }
    }
}
