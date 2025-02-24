<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;
use App\Models\Items;
use App\Models\Comments;
use App\Models\Settings;
use App\Models\User;
use App\Models\Episodes;
use Auth;
use Response;
use DB;

class DetailSeriesController extends Controller{

	public function index($id,Request $request){
		$series = Items::where('slug','=',$id)->first();
        $series->increment('views');

        $allepisodes = Episodes::where('series_id',$series->id)->get();
        $uniqueSeason = $allepisodes->unique('season_id')->all();

        $relatedseries = Items::inRandomOrder()->where('type','series')->whereHas('genres', function ($q) use ($series) {
		    $q->whereIn('name', $series->genres->pluck('name'));
		})
		->where('id', '!=', $id)
		->limit(4)->get();

		$comments = Comments::with('user')->where('post_id','=',$series->id)->where('approve','=',1)->orderBy('id', 'DESC')->get();

		return view('series',compact('series','relatedseries','comments','uniqueSeason'));
	}

	public function getSeasonsEpisodes($series_id,$season_id){
		$allepisodes = Episodes::where('series_id',$series_id)->where('season_id',$season_id)->orderBy('episode_id', 'ASC')->get();
		return view('layouts.episodes', compact('allepisodes'));
	}

	public function comments(Request $request){
    	$settings = Settings::findOrFail('1');
    	$site_comments_moderation = $settings->site_comments_moderation;

    	$user = User::find(Auth::user()->id);

    	$comments = new Comments();
        $comments->title = $request->itemname;
        $comments->post_id = $request->itemid;
        $comments->user_name = $user->name;
        $comments->email = $user->email;
        $comments->comment = $request->body;
        $comments->type = 0;

        if($site_comments_moderation == 1){
            $comments->approve = 0;
            $comments->save();
            return redirect(url()->previous().'#comment-form')->with('success','Your comment is awaiting moderation!');
        }else{
            $comments->approve = 1;
        }
        $comments->save();
        return redirect(url()->previous().'#comment-form')->with('success','Comments Added Successfully!');
    }

    public function deletecomments($id, Request $request){
    	$userid = Auth::id();
        $user = User::find($userid);

        if($userid == null){
            return redirect()->back()->with('success','User not login!');
        }else{
            $commentdata = Comments::find($id);
            $commentemail = $commentdata->email;
            $useremail = $user->email;

            if($useremail == $commentemail ){
                //Delete comment
                $comment = Comments::where('id', $id);
                $comment->forceDelete();
                return redirect(url()->previous().'#comment-form')->with('success','Comments Deleted Successfully!');
            }else{
                return redirect(url()->previous().'#comment-form')->with('success','This Comment is not yours!');
            }
        }
    }

}
