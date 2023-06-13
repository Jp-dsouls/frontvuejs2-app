<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SectorType;

class SectortypeController extends Controller
{
    public function recent_orders() {
        $sectortype = SectorType::get();
        return response()->json($sectortype);
    }
}
