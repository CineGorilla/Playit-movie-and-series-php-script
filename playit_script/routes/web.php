<?php

use Illuminate\Support\Facades\Route;
use App\Models\Settings;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

/////////////////////////
// Maintenance //////////
/////////////////////////

Route::get('/maintenance', function () {
	$general = Settings::findOrFail('1');
    return view('maintenance', compact('general'));
})->name('maintenance');

/////////////////////////
// Backend //////////////
/////////////////////////
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin','middleware' => 'App\Http\Middleware\CheckAdmin::class'], function () {
	/////////////////////////
	// Dashboard ////////////
	/////////////////////////
	// Dashboard [View]
	Route::get('/', 'IndexController@index');
	//Data Fetch
	Route::get('/data/get_genres', 'DataController@get_genres');
	Route::get('/data/get_countries', 'DataController@get_countries');
	Route::get('/data/get_actors', 'DataController@get_actors');
	Route::get('/data/get_creators', 'DataController@get_creators');
	Route::get('/data/get_directors', 'DataController@get_directors');
	Route::get('/data/get_keywords', 'DataController@get_keywords');
	Route::get('/data/get_quality', 'DataController@get_quality');
	Route::get('/data/get_series', 'DataController@get_series');
	Route::get('/data/get_newsletters', 'DataController@get_newsletters');

	/////////////////////////
	// Genres ///////////////
	/////////////////////////
	// Views ////////////////
	// Genres lists [View]
	Route::get('/genres', 'GenresController@lists_genres')->middleware(['can:genres_index']);
	// Genre add [View]
	Route::get('/genres/add', 'GenresController@add_genre')->middleware(['can:genres_add']);
	// Genre edit [View]
	Route::get('/genres/edit/{id}', 'GenresController@edit_genre')->middleware(['can:genres_update']);
	// No-Views /////////////
	// Genre Delete
	Route::get('/genres/delete/{id}', 'GenresController@delete')->middleware(['can:genres_delete']);
	Route::post('/genres/delete', 'GenresController@save_genre')->name('delete_genre')->middleware(['can:genres_delete']);
	// Genre Save
	Route::post('/genres/save', 'GenresController@save_genre')->name('save_genre')->middleware(['can:genres_add']);
	// Genre Visible
	Route::post('/genres/visible', 'GenresController@visible')->name('save_genre_visible')->middleware(['can:genres_update']);
	// Genre update
	Route::get('/genres/update/{id}', 'GenresController@update_genre')->name('update_genre')->middleware(['can:genres_update']);
	/////////////////////////
	// Movies ///////////////
	/////////////////////////
	// Views ////////////////
	// Movies lists
	Route::get('/movies', 'MovieController@lists_movies')->middleware(['can:movie_index']);
	// Movie add
	Route::get('/movies/add', 'MovieController@add_movie')->middleware(['can:movie_add']);
	// Movie edit [View]
	Route::get('/movies/edit/{id}', 'MovieController@edit_movie')->middleware(['can:movie_update']);
	// No-Views /////////////
	// Fetch Movies Details
	Route::get('/movies/get_movie_data/{movie_id}', 'MovieController@get_movie_data')->name('get-movie-data');
	// Movie Save
	Route::post('/movies/save', 'MovieController@save_movie')->name('save_movie')->middleware(['can:movie_add']);
	// Movie update
	Route::put('/movies/update/{id}', 'MovieController@update_movie')->name('update_movie')->middleware(['can:movie_update']);
	// Movie Delete
	Route::get('/movies/delete/{id}', 'MovieController@delete_movie')->name('delete_movie')->middleware(['can:movie_delete']);
	// Movie Visible
	Route::post('/movies/visible', 'MovieController@visible')->name('save_movie_visible')->middleware(['can:movie_update']);
	// Movie Feature
	Route::post('/movies/feature', 'MovieController@feature')->name('save_movie_feature')->middleware(['can:movie_update']);
	// Movie Recommended
	Route::post('/movies/recommended', 'MovieController@recommended')->name('save_movie_recommended')->middleware(['can:movie_update']);
	/////////////////////////
	// Series ///////////////
	/////////////////////////
	// Views ////////////////
	// Series lists [View]
	Route::get('/series', 'SeriesController@lists_series')->middleware(['can:series_index']);
	// Series add [View]
	Route::get('/series/add', 'SeriesController@add_series')->middleware(['can:series_add']);
	// Series edit [View]
	Route::get('/series/edit/{id}', 'SeriesController@edit_series')->middleware(['can:series_update']);
	// No-Views /////////////
	// Fetch Series Details
	Route::get('/series/get_series_data/{series_id}', 'SeriesController@get_series_data')->name('get-series-data');
	Route::post('/series/save', 'SeriesController@save_series')->name('save_series')->middleware(['can:series_add']);
	// Series update
	Route::put('/series/update/{id}', 'SeriesController@update_series')->name('update_series')->middleware(['can:series_update']);
	// Series Delete
	Route::get('/series/delete/{id}', 'SeriesController@delete_series')->name('delete_series')->middleware(['can:movie_delete']);
	// Series Visible
	Route::post('/series/visible', 'SeriesController@visible')->name('save_series_visible')->middleware(['can:series_update']);
	// Series Feature
	Route::post('/series/feature', 'SeriesController@feature')->name('save_series_feature')->middleware(['can:series_update']);
	// Series Recommended
	Route::post('/series/recommended', 'SeriesController@recommended')->name('save_series_recommended')->middleware(['can:series_update']);
	/////////////////////////
	// Episodes /////////////
	/////////////////////////
	// Views ////////////////
	// Episodes lists [View]
	Route::get('/episodes', 'EpisodesController@lists_episodes')->middleware(['can:episodes_index']);
	// Episode add [View]
	Route::get('/episodes/add', 'EpisodesController@add_episode')->middleware(['can:episodes_add']);
	// Episode edit [View]
	Route::get('/episodes/edit/{id}', 'EpisodesController@edit_episode')->middleware(['can:episodes_update']);
	// No-Views /////////////
	// Fetch Episodes Details
	Route::get('/episodes/get_series/{series_id}', 'EpisodesController@get_series_seasons')->name('get-series-seasons');
	Route::get('/episodes/get_series/{series_id}/{season_id}', 'EpisodesController@get_series_episodes')->name('get-series-episodes');
	Route::get('/episodes/get_series/{series_id}/{season_id}/{episode_id}', 'EpisodesController@get_episodes_data')->name('get-episodes-data');
	//Save Episode
	Route::post('/episodes/save', 'EpisodesController@save_episodes')->name('save_episodes')->middleware(['can:episodes_add']);
	// Series update
	Route::put('/episodes/update/{id}', 'EpisodesController@update_episodes')->name('update_episodes')->middleware(['can:episodes_update']);
	//Delete Episode
	Route::get('/episodes/delete/{id}', 'EpisodesController@delete_episodes')->name('delete_episodes')->middleware(['can:episodes_delete']);
	/////////////////////////
	// Pages ////////////////
	/////////////////////////
	// Views ////////////////
	// Pages lists [View]
	Route::get('/pages', 'PagesController@lists_pages')->middleware(['can:pages_index']);
	// Pages add [View]
	Route::get('/pages/add', 'PagesController@add_pages')->middleware(['can:pages_add']);
	// Pages edit [View]
	Route::get('/pages/edit/{id}', 'PagesController@edit_pages')->middleware(['can:pages_update']);
	// No-Views /////////////
	Route::post('/pages/save', 'PagesController@save_pages')->name('save_pages')->middleware(['can:pages_add']);
	// Pages update
	Route::put('/pages/update/{id}', 'PagesController@update_pages')->name('update_pages')->middleware(['can:pages_update']);
	//Delete Episode
	Route::get('/pages/delete/{id}', 'PagesController@delete_pages')->name('delete_pages')->middleware(['can:pages_delete']);
	// Pages Visible
	Route::post('/pages/visible', 'PagesController@visible')->name('save_pages_visible')->middleware(['can:pages_update']);
	/////////////////////////
	// Users ////////////////
	/////////////////////////
	// Views ////////////////
	// Users lists [View]
	Route::get('/users', 'UsersController@lists_users')->middleware(['can:users_index']);
	// Users add [View]
	Route::get('/users/add', 'UsersController@add_users')->middleware(['can:users_add']);
	// Users edit [View]
	Route::get('/users/edit/{id}', 'UsersController@edit_users')->middleware(['can:users_update']);
	// No-Views /////////////
	Route::post('/users/save', 'UsersController@save_users')->name('save_users')->middleware(['can:users_add']);
	// Users update
	Route::put('/users/update/{id}', 'UsersController@update_users')->name('update_users')->middleware(['can:users_update']);
	// Users Delete
	Route::get('/users/delete/{id}', 'UsersController@delete_users')->name('delete_users')->middleware(['can:users_delete']);
	// Users Block
	Route::post('/users/block', 'UsersController@block')->name('save_users_block')->middleware(['can:users_update']);
	/////////////////////////
	// Comments /////////////
	/////////////////////////
	// Views ////////////////
	// Comments lists [View]
	Route::get('/comments', 'CommentsController@lists_comments')->middleware(['can:comments_index']);
	Route::get('/comments/{id}', 'CommentsController@show')->name('comments-with')->middleware(['can:comments_index']);


	Route::get('/comments/delete/{id}', 'CommentsController@delete_comments')->name('delete_comments')->middleware(['can:comments_delete']);
	Route::post('/comments/approve', 'CommentsController@approve_comments')->name('approve_comments')->middleware(['can:comments_index']);
	/////////////////////////
	// Newsletters //////////
	/////////////////////////
	// Views ////////////////
	// Newsletter lists [View]
	Route::get('/newsletter', 'NewslettersController@lists_newsletter')->middleware(['can:newsletters_index']);
	// Newsletter send [View]
	Route::get('/newsletter/send', 'NewslettersController@send_newsletter')->middleware(['can:newsletters_index']);
	// No-Views /////////////
	Route::post('/newsletter/send_email', 'NewslettersController@send_email')->name('send_email')->middleware(['can:newsletters_send']);

	/////////////////////////
	// Profile //////////////
	/////////////////////////
	// Views ////////////////
	// Profile [View]
	Route::get('/profile', 'ProfileController@edit_profile')->middleware(['can:profile_index']);
	// Profile save [View]
	// No-Views /////////////
	Route::put('/profile/save/{id}', 'ProfileController@save_profile')->name('save_profile')->middleware(['can:profile_update']);
	/////////////////////////
	// Sitemaps /////////////
	/////////////////////////
	// Views ////////////////
	// Sitemaps [View]
	Route::get('/sitemaps', 'SitemapsController@sitemaps_lists');
	// Sitemaps save [View]
	// No-Views /////////////
	Route::post('/sitemaps/index', 'SitemapsController@sitemapsindex');
	Route::post('/sitemaps/movie', 'SitemapsController@sitemapsmovie');
	Route::post('/sitemaps/series', 'SitemapsController@sitemapsseries');
	Route::post('/sitemaps/episodes', 'SitemapsController@sitemapsepisodes');
	Route::post('/sitemaps/page', 'SitemapsController@sitemapspage');
	Route::post('/sitemaps/genre', 'SitemapsController@sitemapsgenre');
	/////////////////////////
	// Settings /////////////
	/////////////////////////
	// Views ////////////////
	// Settings [View]
	Route::get('/settings/general', 'SettingsController@general_settings')->middleware(['can:settings_index']);
	Route::get('/settings/search_engines', 'SettingsController@search_engines')->middleware(['can:settings_index']);
	Route::get('/settings/advertisement', 'SettingsController@advertisement')->middleware(['can:settings_index']);
	// No-Views /////////////
	Route::put('/settings/general/update', 'SettingsController@update_general_settings')->name('update_general_settings')->middleware(['can:settings_update']);
	Route::put('/settings/search_engines/update', 'SettingsController@update_search_engines_settings')->name('update_search_engines_settings')->middleware(['can:settings_update']);
	Route::put('/settings/advertisement/update', 'SettingsController@update_advertisement_settings')->name('update_advertisement_settings')->middleware(['can:settings_update']);

    Route::get('/settings/permissions', 'PermissionsController@index')->name('index-permissions')->middleware(['role:administrators']);

    Route::put('/settings/update_administrators_permissions', 'PermissionsController@update_administrators_permissions')->name('update_administrators_permissions')->middleware(['role:administrators']);
    Route::put('/settings/update_moderators_permissions', 'PermissionsController@update_moderators_permissions')->name('update_moderators_permissions')->middleware(['role:administrators']);
    Route::put('/settings/update_authors_permissions', 'PermissionsController@update_authors_permissions')->name('update_authors_permissions')->middleware(['role:administrators']);


    /////////////////////////
	// Stats /////////////
	/////////////////////////
	// Views ////////////////
	// Stats [View]
	Route::get('/stats', 'StatsController@realtime')->middleware(['can:stats_index']);
	Route::get('/stats/pageviews', 'StatsController@pageviews')->middleware(['can:stats_index']);
	Route::get('/stats/seo-stats', 'StatsController@seostats')->middleware(['can:stats_index']);
});

Route::group(['namespace' => 'App\Http\Controllers','middleware' => 'App\Http\Middleware\CheckMaintenance::class'], function () {
    //Homepage
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/home', 'HomeController@index')->name('home');

    //Newsletter Store
	Route::post('/newsletter/store', 'Admin\NewslettersController@store');

    //Page
	Route::get('/page/{id}', 'ListsController@page')->name('single-page');

    //Add Watchlist
	Route::post('/watchlist', 'WatchlistsController@addWatchlist');

    //Movie Lists
	Route::get('/movies', 'ListsController@movies_list')->name('movies-lists');
	//Series Lists
	Route::get('/series', 'ListsController@series_list')->name('series-lists');
	//Latest Episodes
	Route::get('/latest-episodes', 'ListsController@latest_episode_list')->name('latest-episode-list');

    //Movie
	Route::get('/movie/{id}', 'DetailMovieController@index')->name('single-movie');
    //Movie Comments
	Route::post('/movie-comments', 'DetailMovieController@comments');
	Route::get('/movie-delete-comment/{id}', 'DetailMovieController@deletecomments');

    //Series
	Route::get('/series/{id}', 'DetailSeriesController@index')->name('single-series');
	//Series Comments
	Route::post('/series-comments', 'DetailSeriesController@comments');
	Route::get('/series-delete-comment/{id}', 'DetailSeriesController@deletecomments');

    //Episodes
	Route::get('/{id}/{series_slug}/season-{series_season}/episode-{series_episode}', 'DetailEpisodeController@index')->name('single-episode');
	//Episodes Comments
	Route::post('/episode-comments', 'DetailEpisodeController@comments');
	Route::get('/episode-delete-comment/{id}', 'DetailEpisodeController@deletecomments');

	//Seasons Episodes
	Route::get('/get-season-episodes/series-{series_id}/season-{season_id}', 'DetailSeriesController@getSeasonsEpisodes');

    //User Watchlists
    Route::get('/watchlists', 'WatchlistsController@usersWatchlist');
    //Start With
	Route::get('/start-with/{id}', 'ListingsController@start_with')->name('start-with-list');
	//Trending
	Route::get('/trending', 'ListingsController@trending')->name('trending-list');
	//Genres
	Route::get('/genre/{id}', 'ListingsController@genres')->name('genres-list');
	//Country
	Route::get('/country/{id}', 'ListingsController@country')->name('country-list');
	//Year
	Route::get('/year/{id}', 'ListingsController@year')->name('year-list');
	//Quality
	Route::get('/quality/{id}', 'ListingsController@quality')->name('quality-list');
	//Director
	Route::get('/director/{id}', 'ListingsController@director')->name('director-list');
	//Creator
	Route::get('/creator/{id}', 'ListingsController@creator')->name('creator-list');
	//Actor
	Route::get('/actor/{id}', 'ListingsController@actor')->name('actor-list');
	//Search Lists
	Route::get('/search','ListingsController@search')->name('search');


});
