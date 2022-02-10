<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $akses = $this->aksesRole();
        $bread = $this->bread('Master', 'Desa', 'Table', route('admin.dashboard.index'));
        // if ($akses['role'] == "desa") {
        //     $data = [
        //         ''
        //     ];
        //     return view('backend.dashboard.desa', compact('bread'));
        // }
        return view('backend.dashboard.index', compact('bread'));
    }
}
