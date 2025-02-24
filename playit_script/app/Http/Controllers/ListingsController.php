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

class ListingsController extends Controller{

	public function start_with($id){
        $gname = ucwords(str_replace("-"," ",$id));
        $pagename = "Movies and Tv Shows Start With - ".strtoupper($gname);
		$settings = Settings::findOrFail('1');
    	$site_items_per_page = $settings->site_items_per_page;

    	if($id == '0-9'){
    		$data = Items::where('name', 'regexp', '^[0-9]')->orderBy('id', 'DESC')->where('visible', 1)->paginate($site_items_per_page)->onEachSide(1);
    	}else{
    		$data = Items::where('name', 'regexp', '^['.$id.']+')->orderBy('id', 'DESC')->where('visible', 1)->paginate($site_items_per_page)->onEachSide(1);
    	}

		return view('start-with', compact('data','id','pagename'));
	}

    public function trending(){
        $pageitem = "trending";
        $pagename = "Trending Movies and Tv Shows";
        $settings = Settings::findOrFail('1');
        $site_items_per_page = $settings->site_items_per_page;
        $data = Items::orderBy('views', 'DESC')->paginate($site_items_per_page)->onEachSide(1);
        return view('lists',compact('data','pagename','pageitem'));
    }

    public function genres($id){
        $gname = ucwords(str_replace("-"," ",$id));
        $pageitem = "genres";
        $pagename = "Genres - ".strtoupper($gname);
        $settings = Settings::findOrFail('1');
        $site_items_per_page = $settings->site_items_per_page;
        $data = Items::whereHas('genres', function ($subQuery) use ($id) {
            $subQuery->where('name', ucwords(str_replace("-"," ",$id)));
        })->orderBy('id', 'DESC')->where('visible', 1)->paginate($site_items_per_page)->onEachSide(1);
        return view('lists',compact('data','pagename','pageitem','id'));
    }

    public function country($id){
        $gname = ucwords(str_replace("-"," ",$id));
        $pageitem = "country";
        $pagename = "Country - ".strtoupper($gname);
        $settings = Settings::findOrFail('1');
        $site_items_per_page = $settings->site_items_per_page;
        $data = Items::whereHas('countries', function ($subQuery) use ($id) {
            $subQuery->where('name', ucwords(str_replace("-"," ",$id)));
        })->orderBy('id', 'DESC')->where('visible', 1)->paginate($site_items_per_page)->onEachSide(1);
        return view('lists',compact('data','pagename','pageitem','id'));
    }

    public function year($id){
        $gname = ucwords(str_replace("-"," ",$id));
        $pageitem = "year";
        $pagename = "Year - ".strtoupper($gname);
        $settings = Settings::findOrFail('1');
        $site_items_per_page = $settings->site_items_per_page;
        $data = Items::whereHas('years', function ($subQuery) use ($id) {
            $subQuery->where('name', ucwords(str_replace("-"," ",$id)));
        })->orderBy('id', 'DESC')->where('visible', 1)->paginate($site_items_per_page)->onEachSide(1);
        return view('lists',compact('data','pagename','pageitem','id'));
    }

    public function quality($id){
        $gname = ucwords(str_replace("-"," ",$id));
        $pageitem = "quality";
        $pagename = "Quality - ".strtoupper($gname);
        $settings = Settings::findOrFail('1');
        $site_items_per_page = $settings->site_items_per_page;
        $data = Items::whereHas('qualities', function ($subQuery) use ($id) {
            $subQuery->where('name', ucwords($id));
        })->orderBy('id', 'DESC')->where('visible', 1)->paginate($site_items_per_page)->onEachSide(1);
        return view('lists',compact('data','pagename','pageitem','id'));
    }

    public function director($id){
        $gname = ucwords(str_replace("-"," ",$id));
        $pageitem = "director";
        $pagename = "Director - ".strtoupper($gname);
        $settings = Settings::findOrFail('1');
        $site_items_per_page = $settings->site_items_per_page;
        $data = Items::whereHas('directors', function ($subQuery) use ($id) {
            $subQuery->where('name', ucwords(str_replace("-"," ",$id)));
        })->orderBy('id', 'DESC')->where('visible', 1)->paginate($site_items_per_page)->onEachSide(1);
        return view('lists',compact('data','pagename','pageitem','id'));
    }

    public function creator($id){
        $gname = ucwords(str_replace("-"," ",$id));
        $pageitem = "creator";
        $pagename = "Creator - ".strtoupper($gname);
        $settings = Settings::findOrFail('1');
        $site_items_per_page = $settings->site_items_per_page;
        $data = Items::whereHas('creators', function ($subQuery) use ($id) {
            $subQuery->where('name', ucwords(str_replace("-"," ",$id)));
        })->orderBy('id', 'DESC')->where('visible', 1)->paginate($site_items_per_page)->onEachSide(1);
        return view('lists',compact('data','pagename','pageitem','id'));
    }

    public function actor($id){
        $gname = ucwords(str_replace("-"," ",$id));
        $pageitem = "actor";
        $pagename = "Actor - ".strtoupper($gname);
        $settings = Settings::findOrFail('1');
        $site_items_per_page = $settings->site_items_per_page;
        $data = Items::whereHas('actors', function ($subQuery) use ($id) {
            $subQuery->where('name', ucwords(str_replace("-"," ",$id)));
        })->orderBy('id', 'DESC')->where('visible', 1)->paginate($site_items_per_page)->onEachSide(1);
        return view('lists',compact('data','pagename','pageitem','id'));
    }

    public function search(Request $request){

        if($request->ajax()) {
            if($request->items == ''){

            }else{
                $data = Items::where('name', 'LIKE', $request->items.'%')
                ->limit(5)->get();

                $output = '';
                if (count($data)>0) {
                    $output = '<div class="flex justify-center flex-wrap">';
                        foreach ($data as $items){
                            $output .= '<div class="relative inline-block bg-none m-2" style="width:240px">';
                                $output .= '<div class="slide">';
                                    $output .= '<div class="card-wrapper">';
                                        $output .= '<a href="';
                                                if($items->type == 'movie' ){
                                                    $output .= ''.url('/movie').'';
                                                }else {
                                                    $output .= ''.url('/series').'';
                                                }
                                                $output .= '/'.$items->slug.'';
                                                $output .= '">';
                                            $output .= '<div class="card1 inline-top loaded portrait-card" style="width:240px">';
                                                $output .= '<div class="card-content-wrap">';
                                                    $output .= '<div class="card-image-content">';
                                                        $output .= '<div class="image-card base-card-image">';
                                                            $output .= '<img alt="'.$items->name.'( '.date('Y',strtotime($items->release_date)) .')" title="'.$items->name.'( '.date('Y',strtotime($items->release_date)) .')" class="original-image " src="'.$items->poster.'">';
                                                        $output .= '</div>';
                                                        $output .= '<div>';
                                                            $output .= '<div class="card-overlay show-icon"></div>';
                                                        $output .= '</div>';
                                                    $output .= '</div>';
                                                    $output .= '<div class="card-details ">';
                                                        $output .= '<h3 class="text-overflow card-header">'.$items->name.'( '.date('Y',strtotime($items->release_date)) .')</h3>';
                                                        $output .= '<div class="text-overflow card-subheader"><i class="fas fa-star"></i>&nbsp;&nbsp;'.$items->rating.'&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-eye"></i>&nbsp;&nbsp;'.$items->views.'</div>';
                                                    $output .= '</div>';
                                                $output .= '</div>';
                                            $output .= '</div>';
                                        $output .= '</a>';
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        }
                    $output .= '</div>';
                }
                else {
                    $output .= '<div class="flex justify-center flex-wrap"> No results </div>';
                }
                return $output;
            }
        }

    }




}
