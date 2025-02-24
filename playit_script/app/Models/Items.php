<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{   
    use HasFactory;

    public function watchlists(){
        return $this->hasMany('App\Models\Watchlist');
    }

    public function episodes(){
        return $this->hasMany('App\Models\Episodes');
    }

    public function genres(){
        return $this->belongsToMany('App\Models\Genres');
    }

    public function actors(){
        return $this->belongsToMany('App\Models\Actors');
    }

    public function creators(){
        return $this->belongsToMany('App\Models\Creators');
    }

    public function directors(){
        return $this->belongsToMany('App\Models\Directors');
    }

    public function keywords(){
        return $this->belongsToMany('App\Models\Keywords','keywords_items','items_id','keywords_id');
    }

    public function years(){
        return $this->belongsToMany('App\Models\Years','years_items','items_id','years_id');
    }

    public function qualities(){
        return $this->belongsToMany('App\Models\Qualities','qualities_items','items_id','qualities_id');
    }

    public function countries(){
        return $this->belongsToMany('App\Models\Countries','countries_items','items_id','countries_id');
    }
}