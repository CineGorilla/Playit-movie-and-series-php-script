<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;
use App\Models\Items;
use App\Models\Comments;
use App\Models\Settings;
use App\Models\User;
use Auth;
use Response;

class DetailMovieController extends Controller{

	public function index($id,Request $request){
		$movies = Items::where('slug','=',$id)->first();
        $movies->increment('views');

        $player = json_decode($movies->player, true);

    	$download = json_decode($movies->download);

    	$relatedmovies = Items::inRandomOrder()->where('type','movie')->whereHas('genres', function ($q) use ($movies) {
		    $q->whereIn('name', $movies->genres->pluck('name'));
		})
		->where('id', '!=', $id)
		->limit(12)->get();

		$comments = Comments::with('user')->where('post_id','=',$movies->id)->where('approve','=',1)->orderBy('id', 'DESC')->get();

		return view('movie',compact('movies','player','download','relatedmovies','comments'));
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
        $comments->type = 1;

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
