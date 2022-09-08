<?php

use App\Models\Dictionary;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $statusIds = Dictionary::userStatus()->pluck('id');
        $this->createUser('master@master.com','master','super_admin',$faker->randomElement($statusIds),$faker);


        for ($i=0; $i <5; $i++) {
            $this->createUser($faker->unique()->email,$faker->name,'admin',$faker->randomElement($statusIds),$faker);
        }

        for ($i=0; $i <20; $i++) {
            $this->createUser($faker->unique()->email,$faker->name,'driver',$faker->randomElement($statusIds),$faker);
        }
        for ($i=0; $i <20; $i++) {
            $this->createUser($faker->unique()->email,$faker->name,'patient',$faker->randomElement($statusIds),$faker);
        }
        for ($i=0; $i <20; $i++) {
            $this->createUser($faker->unique()->email,$faker->name,'staff',$faker->randomElement($statusIds),$faker);
        }


    }
    function createUser($email,$name,$role,$statusIds,$faker)
    {
        $user = \App\Models\User::create([
            'name' => $name,
            'email' => $email,
            'phone' => $faker->PhoneNumber,
            'password' => \Illuminate\Support\Facades\Hash::make('secret'),
            'profile_image_url'=>$faker->imageUrl(),
            'status_id'=> $statusIds,
        ]);
        $user->assignRole($role);
    }
}
