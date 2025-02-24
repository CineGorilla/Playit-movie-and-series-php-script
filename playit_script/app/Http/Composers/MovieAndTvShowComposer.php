<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\Items;
use App\Models\Episodes;
use App\Models\Genres;
use App\Models\Years;
use App\Models\Pages;

use Illuminate\Support\Facades\DB;

class MovieAndTvShowComposer{

    public function compose(View $view)
    {
    	$homemovies = Items::orderBy('id','DESC')->where('type', 'movie')->where('visible', 1)->take(16)->get();
        $homeseries = Items::orderBy('id','DESC')->where('type', 'series')->where('visible', 1)->take(16)->get();
        $latest_10_episodes = Episodes::orderBy('id','DESC')->take(16)->get();

        $latest_episodes = Episodes::orderBy('id','DESC')->take(16)->get();

        $randoms = Items::inRandomOrder()->where('visible', 1)->take(16)->get();
        $trending = Items::where('visible', 1)->orderBy('views','DESC')->take(16)->get();
        $recommended = Items::orderBy('id','DESC')->where('visible', 1)->where('recommended',1)->take(16)->get();

        $genres = Genres::orderBy('name', 'DESC')->get();
        $years = Years::orderBy('name', 'DESC')->get();
        $pages = Pages::where('visible', 1)->get();

        $view->with('front_movies', $homemovies);
        $view->with('front_series', $homeseries);
        $view->with('front_latest_episodes', $latest_episodes);
        $view->with('latest_10_episodes', $latest_10_episodes);
        $view->with('trending', $trending);
        $view->with('recommended', $recommended);
        $view->with('randoms', $randoms);
        $view->with('genres', $genres);
        $view->with('years', $years);
        $view->with('front_pages', $pages);
    }

}
