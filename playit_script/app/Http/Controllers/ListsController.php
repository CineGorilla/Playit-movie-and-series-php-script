<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;
use App\Models\Items;
use App\Models\User;
use App\Models\Episodes;
use App\Models\Settings;
use App\Models\Pages;
use Auth;
use Response;
use Cookie;

class ListsController extends Controller{
	public function movies_list(){
		$settings = Settings::findOrFail('1');
    	$site_items_per_page = $settings->site_items_per_page;
		$data = Items::where('type','movie')->orderBy('id', 'DESC')->paginate($site_items_per_page)->onEachSide(1);
        return view('movies-lists',compact('data'));
	}
	public function series_list(){
		$settings = Settings::findOrFail('1');
    	$site_items_per_page = $settings->site_items_per_page;
		$data = Items::where('type','series')->orderBy('id', 'DESC')->paginate($site_items_per_page)->onEachSide(1);
        return view('series-lists',compact('data'));
	}
    public function latest_episode_list(){
        $settings = Settings::findOrFail('1');
        $site_items_per_page = $settings->site_items_per_page;
        $data = Episodes::orderBy('id', 'DESC')->paginate($site_items_per_page)->onEachSide(1);
        return view('latest-episodes',compact('data'));
    }
    public function page($id){
        $pages = Pages::where('visible',1)->where('slug',$id)->first();
        $pages->increment('views');
        return view('pages',compact('pages'));
    }
	public function toggle_style(Request $request) {
        if($request->style == 'dark'){
            $response = redirect('/');
            $response->withCookie(cookie()->forever('style', 'dark'));
            return $response;
        }else{
            $response = redirect('/');
            $response->withCookie(cookie()->forever('style', 'light'));
            return $response;
        }
    }

}