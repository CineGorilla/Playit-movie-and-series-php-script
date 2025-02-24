<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
use Carbon\Carbon;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@me.com',
                'password' => bcrypt('password'),
                'role' => 'administrators',
                'profile_img' => 'default.png',
                'blocked' => 0
            ],
            [
                'name' => 'Moderator',
                'email' => 'moderator@me.com',
                'password' => bcrypt('password'),
                'role' => 'moderators',
                'profile_img' => 'default.png',
                'blocked' => 0
            ],
            [
                'name' => 'Author',
                'email' => 'author@me.com',
                'password' => bcrypt('password'),
                'role' => 'authors',
                'profile_img' => 'default.png',
                'blocked' => 0
            ],
            [
                'name' => 'Member',
                'email' => 'member@me.com',
                'password' => bcrypt('password'),
                'role' => 'members',
                'profile_img' => 'default.png',
                'blocked' => 0
            ]
        ]);

        //AssignRole
        $administrators = User::find(1);
        $administrators->assignRole('administrators');

        $moderators = User::find(2);
        $moderators->assignRole('moderators');

        $authors = User::find(3);
        $authors->assignRole('authors');




    }
}
