<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingsController extends Controller
{
    public function index(){
        return view('listings.index',["listings"=>Listing::latest()->filter(["search"=>request("search"),"tag"=>request("tag")])->paginate(4)]);
    }

    public function show(Listing $listing){
        return view('listings.show',["listing"=>$listing]);
    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $req){
        $fields = $req->validate([
            "title"=>"required",
            "tags"=>"required",
            "company"=>["required",Rule::unique("listings","company")],
            "location"=>"required",
            "email"=>["required","email"],
            "website"=>"required",
            "description"=>"required"
            ]);
        Listing::create($fields);

        /* if($req->hasFile("logo")){ */
        /*     $req->file("logo")->s; */
        /* }; */

        return redirect("/");
    }

    public function destroy(Listing $listing){
        $listing->delete();
        return redirect("/");
    }
}
