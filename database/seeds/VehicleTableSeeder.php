<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $statusIds = Dictionary::userStatus()->pluck('id');
        for ($i=0;$i<15;$i++){
            Vehicle::create([
                'name'=>$faker->name,
                'model' => $faker->year,
                'company' => $faker->company,
                'chassis_no' => $faker->swiftBicNumber,
                'number' => $faker->swiftBicNumber,
                'color' => $faker->colorName,
                'image_url' => $faker->imageUrl(),
                'status_id' => $faker->randomElement($statusIds),
            ]);
        }
    }
}
