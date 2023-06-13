<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Continent;
use App\Models\Country;

class CountryController extends Controller
{
    public function recent_orders($id) {
        $continent=Continent::find($id)->continent;
        $countries = Country::where('continent',$continent)->get();
        return response()->json($countries);
    }
}
