<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\Apartment;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0 ; $i < 10 ; $i++){

            $newApartment = new Apartment();
            $newApartment->descriptive_title = $faker->words(3, true);
            $newApartment->rooms = $faker->randomDigitNotNull();
            $newApartment->beds = $faker->randomDigitNotNull();
            $newApartment->bathrooms = $faker->randomDigitNotNull();
            $newApartment->square_metres = $faker->numberBetween(0, 1000);
            $newApartment->image = $faker->$faker->imageUrl(640, 480, 'house', true);
            $newApartment->description = $faker->paragraph(3, false);
            $newApartment->visibility = 'true';

            $newApartment->save();
        }
    }
}
