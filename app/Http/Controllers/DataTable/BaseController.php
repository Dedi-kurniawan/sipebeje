<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function rupiahFormat($value)
    {
        return number_format($value,2,',','.');
    }

    public function aksesRole()
    {
        return [
            'vendor_id' => Auth::user()->vendor_id,
        ];
    }
}
