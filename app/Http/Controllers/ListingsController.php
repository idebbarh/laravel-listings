<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        if($req->hasFile("logo")){
            $fields["logo"] = $req->file("logo")->store("logos","public");
        };

        Listing::create($fields);

        return redirect("/");
    }

    public function edit(Listing $listing){
        return view("listings.edit",["listing"=>$listing]);
    }

    public function update(Request $req,Listing $listing){
        $fields = $req->validate([
            "title"=>"required",
            "tags"=>"required",
            "company"=>"required",
            "location"=>"required",
            "email"=>["required","email"],
            "website"=>"required",
            "description"=>"required"
            ]);

        if($req->hasFile("logo")){
            if($listing->logo){
                Storage::delete($listing->logo);
            }
            $fields["logo"] = $req->file("logo")->store("logos","public");
        }

        $listing->update($fields);
        return redirect("/");
    }

    public function destroy(Listing $listing){
        $listing->delete();
        return redirect("/");
    }
}
