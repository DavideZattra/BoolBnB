<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;

use App\Models\Apartment;
use App\User;
use App\Models\Amenity;
use App\Models\Sponsor;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $usersId = User::pluck('id')->toArray();
        $amenitiesId = Amenity::pluck('id')->toArray();
        $sponsorsId = Sponsor::pluck('id')->toArray();

        for ($i = 0 ; $i < 20 ; $i++){

            $newApartment = new Apartment();
            $newApartment->user_id = Arr::random($usersId);
            $newApartment->descriptive_title = $faker->words(3, true);
            $newApartment->rooms = $faker->randomDigitNotNull();
            $newApartment->beds = $faker->randomDigitNotNull();
            $newApartment->bathrooms = $faker->randomDigitNotNull();
            $newApartment->square_meters = $faker->numberBetween(0, 1000);
            $newApartment->image = $faker->imageUrl(640, 480, 'house', true);
            $newApartment->description = $faker->paragraph(3, false);
            $newApartment->visibility = true;

            $newApartment->save();

            //random number of amenities added
            for($j = 0; $j < random_int(0, count($amenitiesId)); $j++){

                $role = Arr::random($amenitiesId);
                
                $newApartment->amenities()->attach($role);
                
            }

            // $newApartment->sponsors()->attach(Arr::random($sponsorsId));
        }
    }
}
