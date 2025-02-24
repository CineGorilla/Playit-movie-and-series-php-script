<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

use App\Models\Items;
use App\Models\Episodes;
use App\Models\User;
use App\Models\Newsletters;
use App\Models\Comments;

use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class IndexController extends MainAdminController{  
    public function index()
    {  
    	$user_id = Auth::user()->id;

    	//Total Count
    	$total_movie = Items::where('type','movie')->count();
    	$total_series = Items::where('type','series')->count();
    	$total_episodes = Episodes::count();
    	$total_user = User::count();
        $total_subscribers = Newsletters::count();
        $total_comments = Comments::count();

        //Most Viewed lists
        $most_view_movies = Items::where('type','movie')->orderBy('views', 'DESC')->take(5)->get();
        $most_view_series = Items::where('type','series')->orderBy('views', 'DESC')->take(5)->get();

    	//Latest Lists
    	$latest_users = User::orderBy('id', 'DESC')->take(5)->get();
        $latest_subscribers = Newsletters::orderBy('id', 'DESC')->take(5)->get();

        return view('admin.index',compact('user_id','total_movie','total_series','total_episodes','total_user','total_subscribers','total_comments','most_view_movies','most_view_series','latest_users','latest_subscribers'));
    }

}