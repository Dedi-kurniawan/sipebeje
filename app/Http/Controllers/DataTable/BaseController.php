<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function rupiahFormat($value)
    {
        return number_format($value,0,',','.');
    }

    public function aksesRole()
    {
        if (Auth::user()->role == "desa") {
            $desa_id   = Auth::user()->desa_id;
            $user_id   = Auth::user()->id;
        }else{
            $desa_id   = "";
            $user_id   = "";
        }
        return [
            'desa_id' => $desa_id,
            'vendor_id' => Auth::user()->vendor_id,
            'user_id' => $user_id,
            'role' => Auth::user()->role,
        ];
    }
}
