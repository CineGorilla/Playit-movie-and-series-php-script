<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        //movie
        Permission::create(['name' => 'movie_index']);
        Permission::create(['name' => 'movie_add']);
        Permission::create(['name' => 'movie_update']);
        Permission::create(['name' => 'movie_delete']);
        //Profile
        Permission::create(['name' => 'profile_index']);
        Permission::create(['name' => 'profile_update']);
        //Series
        Permission::create(['name' => 'series_index']);
        Permission::create(['name' => 'series_add']);
        Permission::create(['name' => 'series_update']);
        Permission::create(['name' => 'series_delete']);
        //Comments
        Permission::create(['name' => 'comments_index']);
        Permission::create(['name' => 'comments_delete']);
        //Episodes
        Permission::create(['name' => 'episodes_index']);
        Permission::create(['name' => 'episodes_add']);
        Permission::create(['name' => 'episodes_update']);
        Permission::create(['name' => 'episodes_delete']);
        //Newsletters
        Permission::create(['name' => 'newsletters_index']);
        Permission::create(['name' => 'newsletters_send']);
        //Pages
        Permission::create(['name' => 'pages_index']);
        Permission::create(['name' => 'pages_add']);
        Permission::create(['name' => 'pages_update']);
        Permission::create(['name' => 'pages_delete']);
        //Analytics Stats
        Permission::create(['name' => 'stats_index']);
        //Users
        Permission::create(['name' => 'users_index']);
        Permission::create(['name' => 'users_add']);
        Permission::create(['name' => 'users_update']);
        Permission::create(['name' => 'users_delete']);
        //Settings
        Permission::create(['name' => 'settings_index']);
        Permission::create(['name' => 'settings_update']);
        //Genres
        Permission::create(['name' => 'genres_index']);
        Permission::create(['name' => 'genres_add']);
        Permission::create(['name' => 'genres_update']);
        Permission::create(['name' => 'genres_delete']);

        // this can be done as separate statements
        //Administrators Permissions
        $role = Role::create(['name' => 'administrators']);
        $role->givePermissionTo(Permission::all());

        //Moderators Permissions
        $role = Role::create(['name' => 'moderators'])
            ->givePermissionTo(['movie_index', 'movie_add','movie_update','movie_delete'
            ,'profile_index','profile_update','series_index','series_add','series_update','series_delete'
            ,'comments_index','comments_delete','episodes_index','episodes_add','episodes_update','episodes_delete'
            ,'pages_index','pages_add','pages_update','pages_delete','stats_index','users_index','users_add'
            ,'users_update','users_delete','genres_index','genres_add','genres_update','genres_delete','settings_index']);

        //Authors Permissions
        $role = Role::create(['name' => 'authors'])
        ->givePermissionTo(['movie_index', 'movie_add','movie_update'
        ,'profile_index','profile_update','series_index','series_add','series_update'
        ,'episodes_index','episodes_add','episodes_update'
        ,'pages_index','stats_index','genres_index']);


    }
}
