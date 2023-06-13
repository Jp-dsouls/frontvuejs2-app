<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;

class SectorController extends Controller
{
    public function recent_orders() {

     $sectors = Sector::get();
     return response()->json($sectors);
}
}
