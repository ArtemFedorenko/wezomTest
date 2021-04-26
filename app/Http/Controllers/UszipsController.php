<?php

namespace App\Http\Controllers;

use App\Models\Uszips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UszipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByZip($zipcode)
    {
        $items = DB::table('uszips')->where('zip', $zipcode)->first();
        return response()->json(compact('items'));
    }
    public function getByCity($cityName)
    {
        $items = DB::table('uszips')->where('city', 'like', $cityName . '%')->get();
        return response()->json(compact('items'));
    }

}
