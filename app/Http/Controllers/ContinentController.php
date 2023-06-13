<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Continent;

class ContinentController extends Controller
{
    public function recent_orders() {
        $continents = Continent::get();
        return response()->json($continents);
    }
}
