<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;

class PermissionsController extends MainAdminController{
    //Display Permissions Page
    public function index(Request $request){
        $administratorsRole = Role::findByName('administrators');
        $moderatorsRole = Role::findByName('moderators');
        $authorsRole = Role::findByName('authors');

        return view('admin.settings.permissions',compact('administratorsRole','moderatorsRole','authorsRole'));
    }

    public function update_administrators_permissions(Request $request){
        $role = Role::findByName('administrators');
        if($request->movie_index != null){
            $role->givePermissionTo('movie_index');
        }else{
            $role->revokePermissionTo('movie_index');
        }
        if($request->movie_add != null){
            $role->givePermissionTo('movie_add');
        }else{
            $role->revokePermissionTo('movie_add');
        }
        if($request->movie_update != null){
            $role->givePermissionTo('movie_update');
        }else{
            $role->revokePermissionTo('movie_update');
        }
        if($request->movie_delete != null){
            $role->givePermissionTo('movie_delete');
        }else{
            $role->revokePermissionTo('movie_delete');
        }
        if($request->profile_index != null){
            $role->givePermissionTo('profile_index');
        }else{
            $role->revokePermissionTo('profile_index');
        }
        if($request->profile_update != null){
            $role->givePermissionTo('profile_update');
        }else{
            $role->revokePermissionTo('profile_update');
        }
        if($request->series_index != null){
            $role->givePermissionTo('series_index');
        }else{
            $role->revokePermissionTo('series_index');
        }
        if($request->series_add != null){
            $role->givePermissionTo('series_add');
        }else{
            $role->revokePermissionTo('series_add');
        }
        if($request->series_update != null){
            $role->givePermissionTo('series_update');
        }else{
            $role->revokePermissionTo('series_update');
        }
        if($request->series_delete != null){
            $role->givePermissionTo('series_delete');
        }else{
            $role->revokePermissionTo('series_delete');
        }
        if($request->comments_index != null){
            $role->givePermissionTo('comments_index');
        }else{
            $role->revokePermissionTo('comments_index');
        }
        if($request->comments_delete != null){
            $role->givePermissionTo('comments_delete');
        }else{
            $role->revokePermissionTo('comments_delete');
        }
        if($request->episodes_index != null){
            $role->givePermissionTo('episodes_index');
        }else{
            $role->revokePermissionTo('episodes_index');
        }
        if($request->episodes_add != null){
            $role->givePermissionTo('episodes_add');
        }else{
            $role->revokePermissionTo('episodes_add');
        }
        if($request->episodes_update != null){
            $role->givePermissionTo('episodes_update');
        }else{
            $role->revokePermissionTo('episodes_update');
        }
        if($request->episodes_delete != null){
            $role->givePermissionTo('episodes_delete');
        }else{
            $role->revokePermissionTo('episodes_delete');
        }
        if($request->newsletters_index != null){
            $role->givePermissionTo('newsletters_index');
        }else{
            $role->revokePermissionTo('newsletters_index');
        }
        if($request->newsletters_send != null){
            $role->givePermissionTo('newsletters_send');
        }else{
            $role->revokePermissionTo('newsletters_send');
        }
        if($request->pages_index != null){
            $role->givePermissionTo('pages_index');
        }else{
            $role->revokePermissionTo('pages_index');
        }
        if($request->pages_add != null){
            $role->givePermissionTo('pages_add');
        }else{
            $role->revokePermissionTo('pages_add');
        }
        if($request->pages_update != null){
            $role->givePermissionTo('pages_update');
        }else{
            $role->revokePermissionTo('pages_update');
        }
        if($request->pages_delete != null){
            $role->givePermissionTo('pages_delete');
        }else{
            $role->revokePermissionTo('pages_delete');
        }
        if($request->stats_index != null){
            $role->givePermissionTo('stats_index');
        }else{
            $role->revokePermissionTo('stats_index');
        }
        if($request->users_index != null){
            $role->givePermissionTo('users_index');
        }else{
            $role->revokePermissionTo('users_index');
        }
        if($request->users_add != null){
            $role->givePermissionTo('users_add');
        }else{
            $role->revokePermissionTo('users_add');
        }
        if($request->users_update != null){
            $role->givePermissionTo('users_update');
        }else{
            $role->revokePermissionTo('users_update');
        }
        if($request->users_delete != null){
            $role->givePermissionTo('users_delete');
        }else{
            $role->revokePermissionTo('users_delete');
        }
        if($request->settings_index != null){
            $role->givePermissionTo('settings_index');
        }else{
            $role->revokePermissionTo('settings_index');
        }
        if($request->settings_update != null){
            $role->givePermissionTo('settings_update');
        }else{
            $role->revokePermissionTo('settings_update');
        }
        if($request->genres_index != null){
            $role->givePermissionTo('genres_index');
        }else{
            $role->revokePermissionTo('genres_index');
        }
        if($request->genres_add != null){
            $role->givePermissionTo('genres_add');
        }else{
            $role->revokePermissionTo('genres_add');
        }
        if($request->genres_update != null){
            $role->givePermissionTo('genres_update');
        }else{
            $role->revokePermissionTo('genres_update');
        }
        if($request->genres_delete != null){
            $role->givePermissionTo('genres_delete');
        }else{
            $role->revokePermissionTo('genres_delete');
        }
        $role->save();
        //$role->revokePermissionTo('edit articles');
        return redirect()->action([PermissionsController::class,'index'])->with('success','Changed Administrators Permission');
    }

    public function update_moderators_permissions(Request $request){
        $role = Role::findByName('moderators');
        if($request->movie_index != null){
            $role->givePermissionTo('movie_index');
        }else{
            $role->revokePermissionTo('movie_index');
        }
        if($request->movie_add != null){
            $role->givePermissionTo('movie_add');
        }else{
            $role->revokePermissionTo('movie_add');
        }
        if($request->movie_update != null){
            $role->givePermissionTo('movie_update');
        }else{
            $role->revokePermissionTo('movie_update');
        }
        if($request->movie_delete != null){
            $role->givePermissionTo('movie_delete');
        }else{
            $role->revokePermissionTo('movie_delete');
        }
        if($request->profile_index != null){
            $role->givePermissionTo('profile_index');
        }else{
            $role->revokePermissionTo('profile_index');
        }
        if($request->profile_update != null){
            $role->givePermissionTo('profile_update');
        }else{
            $role->revokePermissionTo('profile_update');
        }
        if($request->series_index != null){
            $role->givePermissionTo('series_index');
        }else{
            $role->revokePermissionTo('series_index');
        }
        if($request->series_add != null){
            $role->givePermissionTo('series_add');
        }else{
            $role->revokePermissionTo('series_add');
        }
        if($request->series_update != null){
            $role->givePermissionTo('series_update');
        }else{
            $role->revokePermissionTo('series_update');
        }
        if($request->series_delete != null){
            $role->givePermissionTo('series_delete');
        }else{
            $role->revokePermissionTo('series_delete');
        }
        if($request->comments_index != null){
            $role->givePermissionTo('comments_index');
        }else{
            $role->revokePermissionTo('comments_index');
        }
        if($request->comments_delete != null){
            $role->givePermissionTo('comments_delete');
        }else{
            $role->revokePermissionTo('comments_delete');
        }
        if($request->episodes_index != null){
            $role->givePermissionTo('episodes_index');
        }else{
            $role->revokePermissionTo('episodes_index');
        }
        if($request->episodes_add != null){
            $role->givePermissionTo('episodes_add');
        }else{
            $role->revokePermissionTo('episodes_add');
        }
        if($request->episodes_update != null){
            $role->givePermissionTo('episodes_update');
        }else{
            $role->revokePermissionTo('episodes_update');
        }
        if($request->episodes_delete != null){
            $role->givePermissionTo('episodes_delete');
        }else{
            $role->revokePermissionTo('episodes_delete');
        }
        if($request->newsletters_index != null){
            $role->givePermissionTo('newsletters_index');
        }else{
            $role->revokePermissionTo('newsletters_index');
        }
        if($request->newsletters_send != null){
            $role->givePermissionTo('newsletters_send');
        }else{
            $role->revokePermissionTo('newsletters_send');
        }
        if($request->pages_index != null){
            $role->givePermissionTo('pages_index');
        }else{
            $role->revokePermissionTo('pages_index');
        }
        if($request->pages_add != null){
            $role->givePermissionTo('pages_add');
        }else{
            $role->revokePermissionTo('pages_add');
        }
        if($request->pages_update != null){
            $role->givePermissionTo('pages_update');
        }else{
            $role->revokePermissionTo('pages_update');
        }
        if($request->pages_delete != null){
            $role->givePermissionTo('pages_delete');
        }else{
            $role->revokePermissionTo('pages_delete');
        }
        if($request->stats_index != null){
            $role->givePermissionTo('stats_index');
        }else{
            $role->revokePermissionTo('stats_index');
        }
        if($request->users_index != null){
            $role->givePermissionTo('users_index');
        }else{
            $role->revokePermissionTo('users_index');
        }
        if($request->users_add != null){
            $role->givePermissionTo('users_add');
        }else{
            $role->revokePermissionTo('users_add');
        }
        if($request->users_update != null){
            $role->givePermissionTo('users_update');
        }else{
            $role->revokePermissionTo('users_update');
        }
        if($request->users_delete != null){
            $role->givePermissionTo('users_delete');
        }else{
            $role->revokePermissionTo('users_delete');
        }
        if($request->settings_index != null){
            $role->givePermissionTo('settings_index');
        }else{
            $role->revokePermissionTo('settings_index');
        }
        if($request->settings_update != null){
            $role->givePermissionTo('settings_update');
        }else{
            $role->revokePermissionTo('settings_update');
        }
        if($request->genres_index != null){
            $role->givePermissionTo('genres_index');
        }else{
            $role->revokePermissionTo('genres_index');
        }
        if($request->genres_add != null){
            $role->givePermissionTo('genres_add');
        }else{
            $role->revokePermissionTo('genres_add');
        }
        if($request->genres_update != null){
            $role->givePermissionTo('genres_update');
        }else{
            $role->revokePermissionTo('genres_update');
        }
        if($request->genres_delete != null){
            $role->givePermissionTo('genres_delete');
        }else{
            $role->revokePermissionTo('genres_delete');
        }
        $role->save();
        //$role->revokePermissionTo('edit articles');
        return redirect()->action([PermissionsController::class,'index'])->with('success','Changed Moderators Permission');
    }

    public function update_authors_permissions(Request $request){
        $role = Role::findByName('authors');
        if($request->movie_index != null){
            $role->givePermissionTo('movie_index');
        }else{
            $role->revokePermissionTo('movie_index');
        }
        if($request->movie_add != null){
            $role->givePermissionTo('movie_add');
        }else{
            $role->revokePermissionTo('movie_add');
        }
        if($request->movie_update != null){
            $role->givePermissionTo('movie_update');
        }else{
            $role->revokePermissionTo('movie_update');
        }
        if($request->movie_delete != null){
            $role->givePermissionTo('movie_delete');
        }else{
            $role->revokePermissionTo('movie_delete');
        }
        if($request->profile_index != null){
            $role->givePermissionTo('profile_index');
        }else{
            $role->revokePermissionTo('profile_index');
        }
        if($request->profile_update != null){
            $role->givePermissionTo('profile_update');
        }else{
            $role->revokePermissionTo('profile_update');
        }
        if($request->series_index != null){
            $role->givePermissionTo('series_index');
        }else{
            $role->revokePermissionTo('series_index');
        }
        if($request->series_add != null){
            $role->givePermissionTo('series_add');
        }else{
            $role->revokePermissionTo('series_add');
        }
        if($request->series_update != null){
            $role->givePermissionTo('series_update');
        }else{
            $role->revokePermissionTo('series_update');
        }
        if($request->series_delete != null){
            $role->givePermissionTo('series_delete');
        }else{
            $role->revokePermissionTo('series_delete');
        }
        if($request->comments_index != null){
            $role->givePermissionTo('comments_index');
        }else{
            $role->revokePermissionTo('comments_index');
        }
        if($request->comments_delete != null){
            $role->givePermissionTo('comments_delete');
        }else{
            $role->revokePermissionTo('comments_delete');
        }
        if($request->episodes_index != null){
            $role->givePermissionTo('episodes_index');
        }else{
            $role->revokePermissionTo('episodes_index');
        }
        if($request->episodes_add != null){
            $role->givePermissionTo('episodes_add');
        }else{
            $role->revokePermissionTo('episodes_add');
        }
        if($request->episodes_update != null){
            $role->givePermissionTo('episodes_update');
        }else{
            $role->revokePermissionTo('episodes_update');
        }
        if($request->episodes_delete != null){
            $role->givePermissionTo('episodes_delete');
        }else{
            $role->revokePermissionTo('episodes_delete');
        }
        if($request->newsletters_index != null){
            $role->givePermissionTo('newsletters_index');
        }else{
            $role->revokePermissionTo('newsletters_index');
        }
        if($request->newsletters_send != null){
            $role->givePermissionTo('newsletters_send');
        }else{
            $role->revokePermissionTo('newsletters_send');
        }
        if($request->pages_index != null){
            $role->givePermissionTo('pages_index');
        }else{
            $role->revokePermissionTo('pages_index');
        }
        if($request->pages_add != null){
            $role->givePermissionTo('pages_add');
        }else{
            $role->revokePermissionTo('pages_add');
        }
        if($request->pages_update != null){
            $role->givePermissionTo('pages_update');
        }else{
            $role->revokePermissionTo('pages_update');
        }
        if($request->pages_delete != null){
            $role->givePermissionTo('pages_delete');
        }else{
            $role->revokePermissionTo('pages_delete');
        }
        if($request->stats_index != null){
            $role->givePermissionTo('stats_index');
        }else{
            $role->revokePermissionTo('stats_index');
        }
        if($request->users_index != null){
            $role->givePermissionTo('users_index');
        }else{
            $role->revokePermissionTo('users_index');
        }
        if($request->users_add != null){
            $role->givePermissionTo('users_add');
        }else{
            $role->revokePermissionTo('users_add');
        }
        if($request->users_update != null){
            $role->givePermissionTo('users_update');
        }else{
            $role->revokePermissionTo('users_update');
        }
        if($request->users_delete != null){
            $role->givePermissionTo('users_delete');
        }else{
            $role->revokePermissionTo('users_delete');
        }
        if($request->settings_index != null){
            $role->givePermissionTo('settings_index');
        }else{
            $role->revokePermissionTo('settings_index');
        }
        if($request->settings_update != null){
            $role->givePermissionTo('settings_update');
        }else{
            $role->revokePermissionTo('settings_update');
        }
        if($request->genres_index != null){
            $role->givePermissionTo('genres_index');
        }else{
            $role->revokePermissionTo('genres_index');
        }
        if($request->genres_add != null){
            $role->givePermissionTo('genres_add');
        }else{
            $role->revokePermissionTo('genres_add');
        }
        if($request->genres_update != null){
            $role->givePermissionTo('genres_update');
        }else{
            $role->revokePermissionTo('genres_update');
        }
        if($request->genres_delete != null){
            $role->givePermissionTo('genres_delete');
        }else{
            $role->revokePermissionTo('genres_delete');
        }
        $role->save();
        //$role->revokePermissionTo('edit articles');
        return redirect()->action([PermissionsController::class,'index'])->with('success','Changed Authors Permission');
    }
}
