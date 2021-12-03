<?php

use Illuminate\Database\Seeder;
use App\Models\Address;
use Faker\Generator as Faker;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0 ; $i < 10; $i++){
            $newAddress = new Address();
            $newAddress->country = $faker->state();
            $newAddress->region = $faker->country();
            $newAddress->province = $faker->secondaryAddress();
            $newAddress->city = $faker->city();
            $newAddress->address = $faker->streetAddress();
            $newAddress->zip_code = $faker->postcode();
            $newAddress->lat = $faker->latitude($min = -90, $max = 90);
            $newAddress->lon = $faker->longitude($min = -180, $max = 180);
            $newAddress->save();
        }
    }
}
