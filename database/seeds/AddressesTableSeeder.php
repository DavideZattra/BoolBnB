<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;

use App\Models\Address;
use App\Models\Apartment;
class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartmentsIds = Apartment::pluck('id')->toArray();

        for ($i = 0 ; $i < count($apartmentsIds); $i++){

            $newAddress = new Address();

            $newAddress->apartment_id = $apartmentsIds[$i];
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
    //         $newAddress = new Address();

    //         $newAddress->apartment_id = 1;
    //         $newAddress->country = 'Italy';
    //         $newAddress->region = 'Piemonte';
    //         $newAddress->province = 'To';
    //         $newAddress->city = 'Torino';
    //         $newAddress->address = 'via Oulx 8';
    //         $newAddress->zip_code = 10139;
    //         $newAddress->lat = 45.07285541135327;
    //         $newAddress->lon = 7.637151598397863;
    //         $newAddress->save();
    }
}
