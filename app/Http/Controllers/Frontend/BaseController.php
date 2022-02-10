<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function bread($first, $second, $third, $url)
    {
        return [
            'first' => $first,
            'second' => $second,
            'third' => $third,
            'url' => $url,
        ];
    }
}
