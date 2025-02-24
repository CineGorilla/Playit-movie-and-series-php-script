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
use App\Models\Sliders;

use Image;
use File;

class SeriesController extends MainAdminController{  
    
    //Display Series List
    public function lists_series(Request $request){
        $data = Items::where('type','series')->orderBy('id', 'DESC')->paginate(10)->onEachSide(1);
        return view('admin.series.lists',compact('data'));
    }   

    //Display Series Add
    public function add_series(){
        return view('admin.series.add');
    }  

    //Display Series Edit
    public function edit_series($id){
        $series = Items::find($id);
        return view('admin.series.edit',compact('series'));
    }  

    //CODE Series Save
    public function save_series(Request $request){
        $this->validate($request,[
            'series_name' => 'required|unique:items,name',
            'series_id' => 'nullable|unique:items,tmdb_id',
        ], [ 
            'series_id.unique' => 'TMDB ID which you are trying to add has been already added!(Please Check in trash!)',
            'series_name.unique' => 'Series title already been used!(Please Check in trash!)',
        ]);

        $series = new Items();
        $series->tmdb_id = $request->series_id;
        $series->name = $request->series_name;
        $series->slug = Str::slug($request->series_name);
        $series->tagline = $request->series_tagline;
        $series->description = $request->series_description;
        $series->duration = $request->series_duration;
        $series->rating = $request->series_rating;
        $series->release_date = $request->series_release_date;
        $series->trailer = $request->series_trailer;
        $series->type = 'series';
        $series->views = 0;
        $series->visible = 1;
        $series->feature = 0;
        $series->recommended = 0;
        $series->save();
        //Image Saving
        if($request->series_poster_url == ''){
            $series_poster = $request->file('series_poster');
            if($series_poster == ''){
                $series->poster = asset('backend/images/default_poster.jpg');
            }else{
                $extension_poster = $series_poster->getClientOriginalExtension();
                $file_series_poster = 'series_poster_'.$series->id.'.'.$extension_poster;
                Image::make($series_poster)->resize(405,600)->save(public_path('/assets/series/poster/'.$file_series_poster));
                $series->poster = asset('assets/series/poster/'.$file_series_poster);
            }
        }else{
            $file_series_poster = 'series_poster_'.$series->id.'.jpg';
            Image::make($request->series_poster_url)->resize(405,600)->save(public_path('/assets/series/poster/'.$file_series_poster));
            $series->poster = asset('assets/series/poster/'.$file_series_poster);
        }
        if($request->series_image_url == ''){
            $series_image = $request->file('series_image');
            if($series_image == ''){
                $series->backdrop = asset('backend/images/default.jpg');
            }else{
                $extension_image = $series_image->getClientOriginalExtension();
                $file_series_image = 'series_image_'.$series->id.'.'.$extension_image;
                Image::make($series_image)->resize(1000,600)->save(public_path('/assets/series/backdrop/'.$file_series_image));
                $series->backdrop = asset('assets/series/backdrop/'.$file_series_image);
            }
        }else{
            $file_series_image = 'series_image_'.$series->id.'.jpg';
            Image::make($request->series_image_url)->resize(1000,600)->save(public_path('/assets/series/backdrop/'.$file_series_image));
            $series->backdrop = asset('assets/series/backdrop/'.$file_series_image);
        }
        $series->save();

        //Genres
        if(isset($request->series_genres)){
            $series_genres_arr = explode(",", $request->series_genres);
            $series->genres()->sync($series_genres_arr, false);
        }
        //End Genres

        //Actors
        if(isset($request->series_actors)){
            $series_actors_arr = explode(",", $request->series_actors);
            foreach($series_actors_arr as $actor) {
                $checkactor = Actors::where('name', '=', $actor)->first();
                if (empty($checkactor)) {
                    $actorsId = Actors::create(['name' => $actor,])->id;
                    $series->actors()->sync($actorsId, false);
                }else{
                    $series->actors()->sync($checkactor->id, false);
                }
            }
        }
        //End Actors

        //Keywords
        if(isset($request->series_keywords)){
            $series_keywords_arr = explode(",", $request->series_keywords);
            foreach($series_keywords_arr as $keywords) {
                $checkkeywords = keywords::where('name', '=', $keywords)->first();
                if (empty($checkkeywords)) {
                    $keywordsId = keywords::create(['name' => $keywords])->id;
                    $series->keywords()->sync($keywordsId, false);
                }else{
                    $series->keywords()->sync($checkkeywords->id, false);
                }
            }
        }
        //End Keywords

        //Directors
        if(isset($request->series_directors)){
            $series_directors_arr = explode(",", $request->series_directors);
            foreach($series_directors_arr as $directors) {
                $checkdirectors = Directors::where('name', '=', $directors)->first();
                if (empty($checkdirectors)) {
                    $directorsId = Directors::create(['name' => $directors])->id;
                    $series->directors()->sync($directorsId, false);
                }else{
                    $series->directors()->sync($checkdirectors->id, false);
                }
            }
        }
        //End Directors

        //Creators
        if(isset($request->series_creators)){
            $series_creators_arr = explode(",", $request->series_creators);
            foreach($series_creators_arr as $creators) {
                $checkcreators = Creators::where('name', '=', $creators)->first();
                if (empty($checkcreators)) {
                    $creatorsId = Creators::create(['name' => $creators])->id;
                    $series->creators()->sync($creatorsId, false);
                }else{
                    $series->creators()->sync($checkcreators->id, false);
                }
            }
        }
        //End Creators 

        //Years
        if(isset($request->series_release_date)){
            $years = date('Y', strtotime($request->series_release_date));
            $checkyears = Years::where('name', '=', $years)->first();
            if (empty($checkyears)) {
                $yearsId = Years::create(['name' => $years])->id;
                $series->years()->sync($yearsId, false);
            }else{
                $series->years()->sync($checkyears->id, false);
            }
        }
        //End Years

        //Qualities
        if(isset($request->series_quality)){
            $series_qualities_arr = explode(",", $request->series_quality);
            foreach($series_qualities_arr as $qualities) {
                $checkqualities = Qualities::where('name', '=', $qualities)->first();
                if (empty($checkqualities)) {
                    $qualitiesId = Qualities::create(['name' => $qualities])->id;
                    $series->qualities()->sync($qualitiesId, false);
                }else{
                    $series->qualities()->sync($checkqualities->id, false);
                }
            }
        }
        //End Qualities

        //Countries
        if(isset($request->series_countries)){
            $series_countries_arr = explode(",", $request->series_countries);
            foreach($series_countries_arr as $countries) {
                $checkcountries = Countries::where('name', '=', $countries)->first();
                if (empty($checkcountries)) {
                    $countriesId = Countries::create(['name' => $countries])->id;
                    $series->countries()->sync($countriesId, false);
                }else{
                    $series->countries()->sync($checkcountries->id, false);
                }
            }
        }
        //End Countries

        return redirect()->action([SeriesController::class,'lists_series'])->with('success','Series Created Successfully');
    }

    //CODE Series Update
    public function update_series(Request $request, $id){
        $this->validate($request,[
            'series_name' => 'required',
        ]);
        $series = Items::find($id);
        $series->name = $request->series_name;
        $series->slug = Str::slug($request->series_name);
        $series->tagline = $request->series_tagline;
        $series->description = $request->series_description;
        $series->duration = $request->series_duration;
        $series->rating = $request->series_rating;
        $series->release_date = $request->series_release_date;
        $series->trailer = $request->series_trailer;
        $series->save();
        //Image Saving
        if($request->series_poster_url == ''){
            $series_poster = $request->file('series_poster');
            if($series_poster == ''){
                $series->poster = asset('backend/images/default_poster.jpg');
            }else{
                $extension_poster = $series_poster->getClientOriginalExtension();
                $file_series_poster = 'series_poster_'.$series->id.'.'.$extension_poster;
                Image::make($series_poster)->resize(405,600)->save(public_path('/assets/series/poster/'.$file_series_poster));
                $series->poster = asset('assets/series/poster/'.$file_series_poster);
            }
        }else{
            $file_series_poster = 'series_poster_'.$series->id.'.jpg';
            Image::make($request->series_poster_url)->resize(405,600)->save(public_path('/assets/series/poster/'.$file_series_poster));
            $series->poster = asset('assets/series/poster/'.$file_series_poster);
        }
        if($request->series_image_url == ''){
            $series_image = $request->file('series_image');
            if($series_image == ''){
                $series->backdrop = asset('backend/images/default.jpg');
            }else{
                $extension_image = $series_image->getClientOriginalExtension();
                $file_series_image = 'series_image_'.$series->id.'.'.$extension_image;
                Image::make($series_image)->resize(1000,600)->save(public_path('/assets/series/backdrop/'.$file_series_image));
                $series->backdrop = asset('assets/series/backdrop/'.$file_series_image);
            }
        }else{
            $file_series_image = 'series_image_'.$series->id.'.jpg';
            Image::make($request->series_image_url)->resize(1000,600)->save(public_path('/assets/series/backdrop/'.$file_series_image));
            $series->backdrop = asset('assets/series/backdrop/'.$file_series_image);
        }
        $series->save();
        //Genres
        if(isset($request->series_genres)){
            $series_genres_arr = explode(",", $request->series_genres);
            $series->genres()->sync($series_genres_arr, false);
        }
        //End Genres
        //Actors
        if(isset($request->series_actors)){
            $series_actors_arr = explode(",", $request->series_actors);
            foreach($series_actors_arr as $actor) {
                $checkactor = Actors::where('name', '=', $actor)->first();
                if (empty($checkactor)) {
                    $actorsId = Actors::create(['name' => $actor,])->id;
                    $series->actors()->sync($actorsId, false);
                }else{
                    $series->actors()->sync($checkactor->id, false);
                }
            }
        }
        //End Actors
        //Keywords
        if(isset($request->series_keywords)){
            $series_keywords_arr = explode(",", $request->series_keywords);
            foreach($series_keywords_arr as $keywords) {
                $checkkeywords = keywords::where('name', '=', $keywords)->first();
                if (empty($checkkeywords)) {
                    $keywordsId = keywords::create(['name' => $keywords])->id;
                    $series->keywords()->sync($keywordsId, false);
                }else{
                    $series->keywords()->sync($checkkeywords->id, false);
                }
            }
        }
        //End Keywords
        //Directors
        if(isset($request->series_directors)){
            $series_directors_arr = explode(",", $request->series_directors);
            foreach($series_directors_arr as $directors) {
                $checkdirectors = Directors::where('name', '=', $directors)->first();
                if (empty($checkdirectors)) {
                    $directorsId = Directors::create(['name' => $directors])->id;
                    $series->directors()->sync($directorsId, false);
                }else{
                    $series->directors()->sync($checkdirectors->id, false);
                }
            }
        }
        //End Directors
        //Creators
        if(isset($request->series_creators)){
            $series_creators_arr = explode(",", $request->series_creators);
            foreach($series_creators_arr as $creators) {
                $checkcreators = Creators::where('name', '=', $creators)->first();
                if (empty($checkcreators)) {
                    $creatorsId = Creators::create(['name' => $creators])->id;
                    $series->creators()->sync($creatorsId, false);
                }else{
                    $series->creators()->sync($checkcreators->id, false);
                }
            }
        }
        //End Creators 
        //Years
        if(isset($request->series_release_date)){
            $years = date('Y', strtotime($request->series_release_date));
            $checkyears = Years::where('name', '=', $years)->first();
            if (empty($checkyears)) {
                $yearsId = Years::create(['name' => $years])->id;
                $series->years()->sync($yearsId, false);
            }else{
                $series->years()->sync($checkyears->id, false);
            }
        }
        //End Years
        //Qualities
        if(isset($request->series_quality)){
            $series_qualities_arr = explode(",", $request->series_quality);
            foreach($series_qualities_arr as $qualities) {
                $checkqualities = Qualities::where('name', '=', $qualities)->first();
                if (empty($checkqualities)) {
                    $qualitiesId = Qualities::create(['name' => $qualities])->id;
                    $series->qualities()->sync($qualitiesId, false);
                }else{
                    $series->qualities()->sync($checkqualities->id, false);
                }
            }
        }
        //End Qualities
        //Countries
        if(isset($request->series_countries)){
            $series_countries_arr = explode(",", $request->series_countries);
            foreach($series_countries_arr as $countries) {
                $checkcountries = Countries::where('name', '=', $countries)->first();
                if (empty($checkcountries)) {
                    $countriesId = Countries::create(['name' => $countries])->id;
                    $series->countries()->sync($countriesId, false);
                }else{
                    $series->countries()->sync($checkcountries->id, false);
                }
            }
        }
        //End Countries
        return redirect()->action([SeriesController::class,'lists_series'])->with('success','Series Updated Successfully');
    }

    //CODE Series Delete
    public function delete_series($id){
        $ids = trim($id, '[]');
        $seriesid = explode(",",$ids);
        $series = Items::whereIn('id', $seriesid)->get();

        foreach ($series as $serie ) {   
            //Delete Movie
            $serie->delete();    
        }

        return redirect()->action([SeriesController::class,'lists_series'])->with('success','Series Deleted Successfully!');
    }

    //CODE Genres Visible    
    public function visible(Request $request){
        $series = Items::find($request->id);
        if ($series->visible == 1) {
            $series->visible = 0;
        }else{
            $series->visible = 1;
        }
        $series->save();
    }

    //CODE Movie feature    
    public function feature(Request $request){
        $series = Items::find($request->id);
        if ($series->feature == 1) {
            $series->feature = 0;
        }else{
            $series->feature = 1;
        }
        $series->save();
    }

    //CODE Movie recommended    
    public function recommended(Request $request){
        $series = Items::find($request->id);
        if ($series->recommended == 1) {
            $series->recommended = 0;
        }else{
            $series->recommended = 1;
        }
        $series->save();
    }

    //CODE Get Series Data
    public function get_series_data($series_id){
        $data = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$series_id)
        ->json();

        $cast = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$series_id.'/credits')
        ->json();

        $keywords = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$series_id.'/keywords')
        ->json();

        $video = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$series_id.'/videos')
        ->json('results');

        $output = ['video' => $video];

        return $data+$cast+$keywords+$output;
    }

    


    
}