<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\Episodes;
use App\Models\Items;

use Image;
use File;

class EpisodesController extends MainAdminController{

    //Display Episodes List
    public function lists_episodes(Request $request){
        $data = Episodes::orderBy('id', 'DESC')->paginate(10)->onEachSide(1);
        return view('admin.episodes.lists',compact('data'));
    }

    //Display Episode Add
    public function add_episode(Request $request){
        return view('admin.episodes.add');
    }

    //Display Episode Edit
    public function edit_episode($id){
        $episodes = Episodes::find($id);
        $player = json_decode($episodes->player,true);
        $download = json_decode($episodes->download,true);
        return view('admin.episodes.edit',compact('episodes','player','download'));
    }

    //CODE Get Series Seasons
    public function get_series_seasons($series_id){
        $tmdb = Items::find($series_id);
        $tmdb_id = $tmdb->tmdb_id;
        $data = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$tmdb_id)
        ->json();
        return $data;
    }

    //CODE Get Series Seasons/Episodes
    public function get_series_episodes($series_id,$season_id){
        $tmdb = Items::find($series_id);
        $tmdb_id = $tmdb->tmdb_id;
        $data = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$tmdb_id.'/season/'.$season_id)
        ->json();
        return $data;
    }

    //CODE Get Episode Data
    public function get_episodes_data($series_id,$season_id,$episode_id){
        $tmdb = Items::find($series_id);
        $tmdb_id = $tmdb->tmdb_id;
        $data = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$tmdb_id.'/season/'.$season_id.'/episode/'.$episode_id)
        ->json();
        return $data;
    }

    //CODE Save Episode
    public function save_episodes(Request $request){
        $this->validate($request,[
            'series_list' => 'required',
            'episode_unique_id' => 'unique:episodes,episode_unique_id',
        ], [
            'series_list.required' => 'You Must Select Series!',
            'episode_unique_id.unique' => 'You had added this episode already!'
        ]);

        $episodes = new Episodes();

        $episodes->series_id = $request->series_list;

        if($request->tmdb_series_seasons == null){
            if($request->series_seasons != null){
                $seasonid = $request->series_seasons;
            }
        }else{
            $seasonid = $request->tmdb_series_seasons;
        }
        $episodes->season_id = $seasonid;

        if($request->tmdb_series_episode == null){
            if($request->series_episode != null){
                $episodeid = $request->series_episode;
            }
        }else{
            $episodeid = $request->tmdb_series_episode;
        }
        $episodes->episode_id = $episodeid;

        $episodes->episode_unique_id = $request->series_list.$seasonid.$episodeid;

        $episodes->name = $request->episode_name;
        $episodes->description = $request->episode_description;
        $episodes->air_date = $request->episode_airdate;
        $episodes->views = 0;


        // $player = array_combine($request->episode_player_name, $request->episode_player_url);
        // $firstPlayerKey = array_key_first($player);
        // if($firstPlayerKey != ""){
        //     $episodes->player = json_encode($player);
        // }


        $type["type"] = $request->episode_player_type;
        $name["name"] = $request->episode_player_name;
        $url["url"] = $request->episode_player_url;
        $player = array_merge_recursive($type,$name,$url);
        $episodes->player = json_encode($player);


        $download = array_combine($request->episode_download_name, $request->episode_download_url);
        $firstDownloadKey = array_key_first($download);
        if($firstDownloadKey!= "" ){
            $episodes->download = json_encode($download);
        }

        $episodes->save();

        if($request->episode_image_url == ''){
            $episode_image = $request->file('episode_image');
            if($episode_image == ''){
                $episodes->backdrop = asset('backend/images/default.jpg');
            }else{
                $extension_image = $episode_image->getClientOriginalExtension();
                $file_episodes_image = 'episodes_image_'.$episodes->id.'.'.$extension_image;
                Image::make($episode_image)->resize(1000,600)->save(public_path('/assets/episodes/backdrop/'.$file_episodes_image));
                $episodes->backdrop = asset('assets/episodes/backdrop/'.$file_episodes_image);
            }
        }else{
            $file_episodes_image = 'episodes_image_'.$episodes->id.'.jpg';
            Image::make($request->episode_image_url)->resize(1000,600)->save(public_path('/assets/episodes/backdrop/'.$file_episodes_image));
            $episodes->backdrop = asset('assets/episodes/backdrop/'.$file_episodes_image);
        }

        $episodes->save();

        return redirect()->action([EpisodesController::class,'lists_episodes'])->with('success','Episode Created Successfully');
    }

    //CODE Update Episode
    public function update_episodes(Request $request, $id){
        $episodes = Episodes::find($id);
        $episodes->series_id = $request->series_list;

        if($request->tmdb_series_seasons == null){
            if($request->series_seasons != null){
                $seasonid = $request->series_seasons;
            }
        }else{
            $seasonid = $request->tmdb_series_seasons;
        }
        $episodes->season_id = $seasonid;

        if($request->tmdb_series_episode == null){
            if($request->series_episode != null){
                $episodeid = $request->series_episode;
            }
        }else{
            $episodeid = $request->tmdb_series_episode;
        }
        $episodes->episode_id = $episodeid;

        $episodes->episode_unique_id = $request->series_list.$seasonid.$episodeid;

        $episodes->name = $request->episode_name;
        $episodes->description = $request->episode_description;
        $episodes->air_date = $request->episode_airdate;

        // $player = array_combine($request->episode_player_name, $request->episode_player_url);
        // $firstPlayerKey = array_key_first($player);
        // if($firstPlayerKey != ""){
        //     $episodes->player = json_encode($player);
        // }

        $type["type"] = $request->episode_player_type;
        $name["name"] = $request->episode_player_name;
        $url["url"] = $request->episode_player_url;
        $player = array_merge_recursive($type,$name,$url);
        $episodes->player = json_encode($player);


        $download = array_combine($request->episode_download_name, $request->episode_download_url);
        $firstDownloadKey = array_key_first($download);
        if($firstDownloadKey!= "" ){
            $episodes->download = json_encode($download);
        }

        $episodes->save();

        if($request->episode_image_url == ''){
            $episode_image = $request->file('episode_image');
            if($episode_image == ''){
                $episodes->backdrop = asset('backend/images/default.jpg');
            }else{
                $extension_image = $episode_image->getClientOriginalExtension();
                $file_episodes_image = 'episodes_image_'.$episodes->id.'.'.$extension_image;
                Image::make($episode_image)->resize(1000,600)->save(public_path('/assets/episodes/backdrop/'.$file_episodes_image));
                $episodes->backdrop = asset('assets/episodes/backdrop/'.$file_episodes_image);
            }
        }else{
            $file_episodes_image = 'episodes_image_'.$episodes->id.'.jpg';
            Image::make($request->episode_image_url)->resize(1000,600)->save(public_path('/assets/episodes/backdrop/'.$file_episodes_image));
            $episodes->backdrop = asset('assets/episodes/backdrop/'.$file_episodes_image);
        }

        $episodes->save();

        return redirect()->action([EpisodesController::class,'lists_episodes'])->with('success','Episode Updated Successfully');
    }

    //CODE Delete Episode
    public function delete_episodes($id){
        $ids = trim($id, '[]');
        $episodesid = explode(",",$ids);
        $episodes = Episodes::whereIn('id', $episodesid)->get();

        foreach ($episodes as $episode ) {
            //Delete Episode
            $episode->delete();
        }

        return redirect()->action([EpisodesController::class,'lists_episodes'])->with('success','Episodes Deleted Successfully!');
    }

}
