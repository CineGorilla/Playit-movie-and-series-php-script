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

class DetailEpisodeController extends Controller{

	public function index($id,$series_slug,$series_season,$series_episode){
		$eUID = $id.$series_season.$series_episode;

		$series = Items::where('id',$id)->first();
		$episode = Episodes::where('episode_unique_id',$eUID)->first();
        $episode->increment('views');

        $player = json_decode($episode->player, true);
    	$download = json_decode($episode->download);

    	$relatedseries = Items::inRandomOrder()->where('type','series')->whereHas('genres', function ($q) use ($series) {
		    $q->whereIn('name', $series->genres->pluck('name'));
		})
		->where('id', '!=', $id)
		->limit(4)->get();

        $nE = $eUID + 1;
        $pE = $eUID - 1;

        $nextEpisode = Episodes::where('episode_unique_id',$nE)->first();
        $previousEpisode = Episodes::where('episode_unique_id',$pE)->first();

    	$comments = Comments::with('user')->where('post_id','=',$id)->where('season_id','=',$series_season)->where('episode_id','=',$series_episode)->where('approve','=',1)->orderBy('id', 'DESC')->get();

		return view('episode',compact('series','episode','player','download','relatedseries','comments','nextEpisode','previousEpisode'));
	}

	public function comments(Request $request){
    	$settings = Settings::findOrFail('1');
    	$site_comments_moderation = $settings->site_comments_moderation;

    	$user = User::find(Auth::user()->id);

    	$comments = new Comments();
        $comments->title = $request->itemname;
        $comments->post_id = $request->itemid;
        $comments->season_id = $request->sid;
        $comments->episode_id = $request->eid;
        $comments->user_name = $user->name;
        $comments->email = $user->email;
        $comments->comment = $request->body;
        $comments->type = 3;

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
