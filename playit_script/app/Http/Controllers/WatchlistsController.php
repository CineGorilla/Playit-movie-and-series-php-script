<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Watchlist;
use App\Models\Items;
use App\Models\Settings;
use Auth;

class WatchlistsController extends Controller{

	public function addWatchlist(Request $request){

		$items_id = $request->id;
		$iswatchlist = $request->watchlist;
		$item = Items::find($items_id);

		if(!$item){
            return response()->json(['watchlist' => 'error']);
		}

		$user = Auth::user();

		$watchlist = $user->watchlists()->where('items_id',$items_id)->first();

		if($watchlist){
			$already_watchlist = $watchlist->watchlist;
			if($already_watchlist == $iswatchlist){
				$watchlist->delete();
                return response()->json(['watchlist' => true]);
			}
		}else{
			$watchlist = new Watchlist();
		}
		$watchlist->watchlist = $iswatchlist;
		$watchlist->user_id = $user->id;
		$watchlist->items_id = $item->id;
		$watchlist->save();
        return response()->json(['watchlist' => false]);
    }


    public function usersWatchlist(){
    	if(Auth::user()){
    		$userid = Auth::user()->id;
	    	$settings = Settings::findOrFail('1');
	    	$site_items_per_page = $settings->site_items_per_page;

	    	$data = Watchlist::with('items')->where('user_id', $userid)->orderBy('id', 'DESC')->paginate($site_items_per_page)->onEachSide(1);
	    	return view('watchlists',compact('data'));
    	}else{
    		$data = "error";
    		return view('watchlists',compact('data'));
    	}


    }

}
