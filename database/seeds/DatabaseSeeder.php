<?php

use Database\Seeders\VehicleTableSeeder;
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
        $this->call(DictionaryTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(VehicleTableSeeder::class);
    }
}
