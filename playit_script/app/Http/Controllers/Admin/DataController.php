<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Items;
use App\Models\Genres;
use App\Models\Actors;
use App\Models\Directors;
use App\Models\Creators;
use App\Models\Years;
use App\Models\Qualities;
use App\Models\Countries;
use App\Models\Keywords;
use App\Models\Newsletters;


use Image;
use File;

class DataController extends MainAdminController{
	//Get Genres List
    public function get_genres(){
        $genres = Genres::orderBy('name', 'ASC')->get();
        return $genres;
    }
    //Get Countries List
    public function get_countries(){
        $countries = Countries::orderBy('name', 'ASC')->get();
        return $countries;
    }
    //Get Actors List
    public function get_actors(){
        $actors = Actors::orderBy('name', 'ASC')->get();
        return $actors;
    }
    //Get Creators List
    public function get_creators(){
        $creators = Creators::orderBy('name', 'ASC')->get();
        return $creators;
    }
    //Get Directors List
    public function get_directors(){
        $directors = Directors::orderBy('name', 'ASC')->get();
        return $directors;
    }
    //Get Keywords List
    public function get_keywords(){
        $keywords = Keywords::orderBy('name', 'ASC')->get();
        return $keywords;
    }
    //Get Qualities List
    public function get_quality(){
        $qualities = Qualities::orderBy('name', 'ASC')->get();
        return $qualities;
    }

    //Get Series List
    public function get_series(){
        $series = Items::where('type','series')->orderBy('name', 'ASC')->get();
        return $series;
    }

    //Get Newsletters List
    public function get_newsletters(){
        $newsletters = Newsletters::orderBy('id', 'ASC')->get();
        return $newsletters;
    }

    //Get Roles List

    public function get_roles(){
        $roles = \Spatie\Permission\Models\Role::all();
        return $roles;
    }
}
