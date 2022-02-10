<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function bread($first, $second, $third, $url)
    {
        return [
            'first'  => $first,
            'second' => $second,
            'third'  => $third,
            'url'    => $url,
        ];
    }

    public function userId()
    {
        return Auth::user()->id;
    }

    public function vendorId()
    {
        return Auth::user()->vendor_id;
    }

    public function aksesRole()
    {
        if (Auth::user()->role == "desa") {
            $disabled_kecamatan = "disabled";
            $disabled_desa  = "disabled";
            $kecamatan_id   = Auth::user()->desa->kecamatan_id;
            $desa_id        = Auth::user()->desa_id;
            $desa           = Auth::user()->desa->nama;
        }else{
            $disabled_kecamatan = "";
            $disabled_desa  = "";
            $kecamatan_id   = "";
            $desa_id        = "";
            $desa           = "";
        }
        return [
            'desa_id' => $desa_id,
            'kecamatan_id' => $kecamatan_id,
            'disabled_kecamatan' => $disabled_kecamatan,
            'disabled_desa' => $disabled_desa,
            'role' => Auth::user()->role,
            'name' => Auth::user()->name,
            'desa' => $desa,
        ];
    }

    public function convert($number)
    {
        $number = str_replace('.', '', $number);
        if ( ! is_numeric($number)) throw new Exception("Please input number.");
        $base    = array('nol', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
        $numeric = array('1000000000000000', '1000000000000', '1000000000000', 1000000000, 1000000, 1000, 100, 10, 1);
        $unit    = array('kuadriliun', 'triliun', 'biliun', 'milyar', 'juta', 'ribu', 'ratus', 'puluh', '');
        $str     = null;
        $i = 0;
        if ($number == 0) {
            $str = 'nol';
        } else {
            while ($number != 0) {
                $count = (int)($number / $numeric[$i]);
                if ($count >= 10) {
                    $str .= static::convert($count) . ' ' . $unit[$i] . ' ';
                } elseif ($count > 0 && $count < 10) {
                    $str .= $base[$count] . ' ' . $unit[$i] . ' ';
                }
                $number -= $numeric[$i] * $count;
                $i++;
            }
            $str = preg_replace('/satu puluh (\w+)/i', '\1 belas', $str);
            $str = preg_replace('/satu (ribu|ratus|puluh|belas)/', 'se\1', $str);
            $str = preg_replace('/\s{2,}/', ' ', trim($str));
        }
        return $str;
    }
}
