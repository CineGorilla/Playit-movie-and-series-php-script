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


class MovieController extends MainAdminController{

 	//Display Movies List
 	public function lists_movies(Request $request){
        $data = Items::where('type','movie')->orderBy('id', 'DESC')->paginate(10)->onEachSide(1);
        return view('admin.movies.lists',compact('data'));
    }

    //Display Movies Add
 	public function add_movie(){
        return view('admin.movies.add');
        
    }

    //Display Movies Edit
 	public function edit_movie($id){
        $movies = Items::find($id);
        $player = json_decode($movies->player,true);
        $download = json_decode($movies->download,true);

        return view('admin.movies.edit',compact('movies','player','download'));
    }

    //CODE Movie Save
    public function save_movie(Request $request){
        $this->validate($request,[
            'movie_name' => 'required|unique:items,name',
            'movie_id' => 'nullable|unique:items,tmdb_id',
        ], [
            'movie_id.unique' => 'TMDB ID which you are trying to add has been already added!(Please Check in trash!)',
            'movie_name.unique' => 'Movie title already been used!(Please Check in trash!)',
        ]);

        $movies = new Items();
        $movies->tmdb_id = $request->movie_id;
        $movies->name = $request->movie_name;
        $movies->slug = Str::slug($request->movie_name);
        $movies->tagline = $request->movie_tagline;
        $movies->description = $request->movie_description;
        $movies->duration = $request->movie_duration;
        $movies->rating = $request->movie_rating;
        $movies->release_date = $request->movie_release_date;
        $movies->trailer = $request->movie_trailer;
        $movies->type = 'movie';
        $movies->views = 0;
        $movies->visible = 1;
        $movies->feature = 0;
        $movies->recommended = 0;



        // $player = array_combine($request->movie_player_name, $request->movie_player_url);
        // $firstPlayerKey = array_key_first($player);
        // if($firstPlayerKey != ""){
        //     $movies->player = json_encode($player);
        // }


        $type["type"] = $request->movie_player_type;
        $name["name"] = $request->movie_player_name;
        $url["url"] = $request->movie_player_url;

        $player = array_merge_recursive($type,$name,$url);
        $movies->player = json_encode($player);


        // $player = array($request->movie_player_name,$request->movie_player_url,$request->movie_player_type);

        // if($player[0][0] != null){
        //     $movies->player = json_encode($player);
        // }




        $download = array_combine($request->movie_download_name, $request->movie_download_url);
        $firstDownloadKey = array_key_first($download);
        if($firstDownloadKey!= "" ){
            $movies->download = json_encode($download);
        }
        $movies->save();

        if($request->movie_poster_url == ''){
            $movie_poster = $request->file('movie_poster');
            if($movie_poster == ''){
                $movies->poster = asset('backend/images/default_poster.jpg');
            }else{
                $extension_poster = $movie_poster->getClientOriginalExtension();
                $file_movie_poster = 'movie_poster_'.$movies->id.'.'.$extension_poster;
                Image::make($movie_poster)->resize(405,600)->save(public_path('/assets/movies/poster/'.$file_movie_poster));
                $movies->poster = asset('assets/movies/poster/'.$file_movie_poster);
            }
        }else{
            $file_movie_poster = 'movie_poster_'.$movies->id.'.jpg';
            Image::make($request->movie_poster_url)->resize(405,600)->save(public_path('/assets/movies/poster/'.$file_movie_poster));
            $movies->poster = asset('assets/movies/poster/'.$file_movie_poster);
        }

        if($request->movie_image_url == ''){
            $movie_image = $request->file('movie_image');
            if($movie_image == ''){
                $movies->backdrop = asset('backend/images/default.jpg');
            }else{
                $extension_image = $movie_image->getClientOriginalExtension();
                $file_movie_image = 'movie_image_'.$movies->id.'.'.$extension_image;
                Image::make($movie_image)->resize(1000,600)->save(public_path('/assets/movies/backdrop/'.$file_movie_image));
                $movies->backdrop = asset('assets/movies/backdrop/'.$file_movie_image);
            }
        }else{
            $file_movie_image = 'movie_image_'.$movies->id.'.jpg';
            Image::make($request->movie_image_url)->resize(1000,600)->save(public_path('/assets/movies/backdrop/'.$file_movie_image));
            $movies->backdrop = asset('assets/movies/backdrop/'.$file_movie_image);
        }
        $movies->save();

        //Genres
        if(isset($request->movie_genres)){
            $movie_genres_arr = explode(",", $request->movie_genres);
            $movies->genres()->sync($movie_genres_arr, false);
        }
        //End Genres

        //Actors
        if(isset($request->movie_actors)){
            $movie_actors_arr = explode(",", $request->movie_actors);
            foreach($movie_actors_arr as $actor) {
                $checkactor = Actors::where('name', '=', $actor)->first();
                if (empty($checkactor)) {
                    $actorsId = Actors::create(['name' => $actor,])->id;
                    $movies->actors()->sync($actorsId, false);
                }else{
                    $movies->actors()->sync($checkactor->id, false);
                }
            }
        }
        //End Actors

        //Keywords
        if(isset($request->movie_keywords)){
            $movie_keywords_arr = explode(",", $request->movie_keywords);
            foreach($movie_keywords_arr as $keywords) {
                $checkkeywords = keywords::where('name', '=', $keywords)->first();
                if (empty($checkkeywords)) {
                    $keywordsId = keywords::create(['name' => $keywords])->id;
                    $movies->keywords()->sync($keywordsId, false);
                }else{
                    $movies->keywords()->sync($checkkeywords->id, false);
                }
            }
        }
        //End Keywords

        //Directors
        if(isset($request->movie_directors)){
            $movie_directors_arr = explode(",", $request->movie_directors);
            foreach($movie_directors_arr as $directors) {
                $checkdirectors = Directors::where('name', '=', $directors)->first();
                if (empty($checkdirectors)) {
                    $directorsId = Directors::create(['name' => $directors])->id;
                    $movies->directors()->sync($directorsId, false);
                }else{
                    $movies->directors()->sync($checkdirectors->id, false);
                }
            }
        }
        //End Directors

        //Creators
        if(isset($request->movie_creators)){
            $movie_creators_arr = explode(",", $request->movie_creators);
            foreach($movie_creators_arr as $creators) {
                $checkcreators = Creators::where('name', '=', $creators)->first();
                if (empty($checkcreators)) {
                    $creatorsId = Creators::create(['name' => $creators])->id;
                    $movies->creators()->sync($creatorsId, false);
                }else{
                    $movies->creators()->sync($checkcreators->id, false);
                }
            }
        }
        //End Creators

        //Years
        if(isset($request->movie_release_date)){
            $years = date('Y', strtotime($request->movie_release_date));
            $checkyears = Years::where('name', '=', $years)->first();
            if (empty($checkyears)) {
                $yearsId = Years::create(['name' => $years])->id;
                $movies->years()->sync($yearsId, false);
            }else{
                $movies->years()->sync($checkyears->id, false);
            }
        }
        //End Years

        //Qualities
        if(isset($request->movie_quality)){
            $movie_qualities_arr = explode(",", $request->movie_quality);
            foreach($movie_qualities_arr as $qualities) {
                $checkqualities = Qualities::where('name', '=', $qualities)->first();
                if (empty($checkqualities)) {
                    $qualitiesId = Qualities::create(['name' => $qualities])->id;
                    $movies->qualities()->sync($qualitiesId, false);
                }else{
                    $movies->qualities()->sync($checkqualities->id, false);
                }
            }
        }
        //End Qualities

        //Countries
        if(isset($request->movie_countries)){
            $movie_countries_arr = explode(",", $request->movie_countries);
            foreach($movie_countries_arr as $countries) {
                $checkcountries = Countries::where('name', '=', $countries)->first();
                if (empty($checkcountries)) {
                    $countriesId = Countries::create(['name' => $countries])->id;
                    $movies->countries()->sync($countriesId, false);
                }else{
                    $movies->countries()->sync($checkcountries->id, false);
                }
            }
        }
        //End Countries

        return redirect()->action([MovieController::class,'lists_movies'])->with('success','Movie Created Successfully');
    }

    //CODE Movie Update
    public function update_movie(Request $request, $id){
        $this->validate($request,[
            'movie_name' => 'required',
        ]);

        $movies = Items::find($id);

        $movies->name = $request->movie_name;
        $movies->slug = Str::slug($request->movie_name);
        $movies->tagline = $request->movie_tagline;
        $movies->description = $request->movie_description;
        $movies->duration = $request->movie_duration;
        $movies->rating = $request->movie_rating;
        $movies->release_date = $request->movie_release_date;
        $movies->trailer = $request->movie_trailer;


        // $player = array_combine($request->movie_player_name, $request->movie_player_url);
        // $firstPlayerKey = array_key_first($player);
        // if($firstPlayerKey != ""){
        //     $movies->player = json_encode($player);
        // }

        $type["type"] = $request->movie_player_type;
        $name["name"] = $request->movie_player_name;
        $url["url"] = $request->movie_player_url;
        $player = array_merge_recursive($type,$name,$url);
        $movies->player = json_encode($player);


        $download = array_combine($request->movie_download_name, $request->movie_download_url);
        $firstDownloadKey = array_key_first($download);
        if($firstDownloadKey!= "" ){
            $movies->download = json_encode($download);
        }
        $movies->save();

        if($request->movie_poster_url == ''){
            $movie_poster = $request->file('movie_poster');
            if($movie_poster == ''){
                $movies->poster = asset('backend/images/default_poster.jpg');
            }else{
                $extension_poster = $movie_poster->getClientOriginalExtension();
                $file_movie_poster = 'movie_poster_'.$movies->id.'.'.$extension_poster;
                Image::make($movie_poster)->resize(405,600)->save(public_path('/assets/movies/poster/'.$file_movie_poster));
                $movies->poster = asset('assets/movies/poster/'.$file_movie_poster);
            }
        }else{
            $file_movie_poster = 'movie_poster_'.$movies->id.'.jpg';
            Image::make($request->movie_poster_url)->resize(405,600)->save(public_path('/assets/movies/poster/'.$file_movie_poster));
            $movies->poster = asset('assets/movies/poster/'.$file_movie_poster);
        }

        if($request->movie_image_url == ''){
            $movie_image = $request->file('movie_image');
            if($movie_image == ''){
                $movies->backdrop = asset('backend/images/default.jpg');
            }else{
                $extension_image = $movie_image->getClientOriginalExtension();
                $file_movie_image = 'movie_image_'.$movies->id.'.'.$extension_image;
                Image::make($movie_image)->resize(1000,600)->save(public_path('/assets/movies/backdrop/'.$file_movie_image));
                $movies->backdrop = asset('assets/movies/backdrop/'.$file_movie_image);
            }
        }else{
            $file_movie_image = 'movie_image_'.$movies->id.'.jpg';
            Image::make($request->movie_image_url)->resize(1000,600)->save(public_path('/assets/movies/backdrop/'.$file_movie_image));
            $movies->backdrop = asset('assets/movies/backdrop/'.$file_movie_image);
        }
        $movies->save();

        //Genres
        if(isset($request->movie_genres)){
            $movie_genres_arr = explode(",", $request->movie_genres);
            $movies->genres()->sync($movie_genres_arr, false);
        }
        //End Genres

        //Actors
        if(isset($request->movie_actors)){
            $movie_actors_arr = explode(",", $request->movie_actors);
            foreach($movie_actors_arr as $actor) {
                $checkactor = Actors::where('name', '=', $actor)->first();
                if (empty($checkactor)) {
                    $actorsId = Actors::create(['name' => $actor,])->id;
                    $movies->actors()->sync($actorsId, false);
                }else{
                    $movies->actors()->sync($checkactor->id, false);
                }
            }
        }
        //End Actors

        //Keywords
        if(isset($request->movie_keywords)){
            $movie_keywords_arr = explode(",", $request->movie_keywords);
            foreach($movie_keywords_arr as $keywords) {
                $checkkeywords = keywords::where('name', '=', $keywords)->first();
                if (empty($checkkeywords)) {
                    $keywordsId = keywords::create(['name' => $keywords])->id;
                    $movies->keywords()->sync($keywordsId, false);
                }else{
                    $movies->keywords()->sync($checkkeywords->id, false);
                }
            }
        }
        //End Keywords

        //Directors
        if(isset($request->movie_directors)){
            $movie_directors_arr = explode(",", $request->movie_directors);
            foreach($movie_directors_arr as $directors) {
                $checkdirectors = Directors::where('name', '=', $directors)->first();
                if (empty($checkdirectors)) {
                    $directorsId = Directors::create(['name' => $directors])->id;
                    $movies->directors()->sync($directorsId, false);
                }else{
                    $movies->directors()->sync($checkdirectors->id, false);
                }
            }
        }
        //End Directors

        //Creators
        if(isset($request->movie_creators)){
            $movie_creators_arr = explode(",", $request->movie_creators);
            foreach($movie_creators_arr as $creators) {
                $checkcreators = Creators::where('name', '=', $creators)->first();
                if (empty($checkcreators)) {
                    $creatorsId = Creators::create(['name' => $creators])->id;
                    $movies->creators()->sync($creatorsId, false);
                }else{
                    $movies->creators()->sync($checkcreators->id, false);
                }
            }
        }
        //End Creators

        //Years
        if(isset($request->movie_release_date)){
            $years = date('Y', strtotime($request->movie_release_date));
            $checkyears = Years::where('name', '=', $years)->first();
            if (empty($checkyears)) {
                $yearsId = Years::create(['name' => $years])->id;
                $movies->years()->sync($yearsId, false);
            }else{
                $movies->years()->sync($checkyears->id, false);
            }
        }
        //End Years

        //Qualities
        if(isset($request->movie_quality)){
            $movie_qualities_arr = explode(",", $request->movie_quality);
            foreach($movie_qualities_arr as $qualities) {
                $checkqualities = Qualities::where('name', '=', $qualities)->first();
                if (empty($checkqualities)) {
                    $qualitiesId = Qualities::create(['name' => $qualities])->id;
                    $movies->qualities()->sync($qualitiesId, false);
                }else{
                    $movies->qualities()->sync($checkqualities->id, false);
                }
            }
        }
        //End Qualities

        //Countries
        if(isset($request->movie_countries)){
            $movie_countries_arr = explode(",", $request->movie_countries);
            foreach($movie_countries_arr as $countries) {
                $checkcountries = Countries::where('name', '=', $countries)->first();
                if (empty($checkcountries)) {
                    $countriesId = Countries::create(['name' => $countries])->id;
                    $movies->countries()->sync($countriesId, false);
                }else{
                    $movies->countries()->sync($checkcountries->id, false);
                }
            }
        }
        //End Countries

        return redirect()->action([MovieController::class,'lists_movies'])->with('success','Movie Updated Successfully');
    }

    //CODE Movie Delete
    public function delete_movie($id){
        $ids = trim($id, '[]');
        $movieid = explode(",",$ids);
        $movies = Items::whereIn('id', $movieid)->get();

        foreach ($movies as $movie ) {
            //Delete Movie
            $movie->delete();
        }

        return redirect()->action([MovieController::class,'lists_movies'])->with('success','Movies Deleted Successfully!');
    }

    //CODE Genres Visible
    public function visible(Request $request){
        $movies = Items::find($request->id);
        if ($movies->visible == 1) {
            $movies->visible = 0;
        }else{
            $movies->visible = 1;
        }
        $movies->save();
    }

    //CODE Movie feature
    public function feature(Request $request){
        $movies = Items::find($request->id);
        if ($movies->feature == 1) {
            $movies->feature = 0;
        }else{
                $movies->feature = 1;
        }
        $movies->save();
    }

    //CODE Movie recommended
    public function recommended(Request $request){
        $movies = Items::find($request->id);
        if ($movies->recommended == 1) {
            $movies->recommended = 0;
        }else{
            $movies->recommended = 1;
        }
        $movies->save();
    }

    //CODE Get Movies Data
    public function get_movie_data($movie_id){
        $data = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$movie_id)
        ->json();

        $cast = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$movie_id.'/credits')
        ->json();

        $video = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$movie_id.'/videos')
        ->json();

        $keywords = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$movie_id.'/keywords')
        ->json();

        return $data+$cast+$video+$keywords;
    }
}
