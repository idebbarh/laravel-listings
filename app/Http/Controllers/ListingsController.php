<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class ListingsController extends Controller
{
    public static function index(){
        return view('listings',["listings"=>Listing::all()]);
    }

    public static function show(Listing $listing){
        return view('listing',["listing"=>$listing]);
    }
}
