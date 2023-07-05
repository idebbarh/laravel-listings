<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ["title","tags","company","location","email","website","description"];

    public function scopeFilter($query, array $filters){
        if($filters['search']){
            $search =$filters['search'];
            $query->where("title","like","%".$search."%")->orWhere("description","like","%".$search."%");
        }

        if($filters['tag']){
            $tag=$filters['tag'];
            $query->where("tags","like","%".$tag."%");
        };
    }
}
