<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(GeneralSettingSeeder::class);
        $this->call(SearchEnginesSettingSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(AdsSeeder::class);
    }
}
