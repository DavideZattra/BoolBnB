<?php

use Illuminate\Database\Seeder;

use App\Models\Amenity;

class AmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenitiesNames = ['WiFi', 'Balcon', 'Breakfast', 'View', 'Parking', 'Pool', 'Sauna', 'Washing Machine', 'Heating', 'Air conditioning', 'Indoor', 'fireplace', 'Iron', 'TV', 'Self check-in'];

        for ($i = 0 ; $i < 15; $i++){

            $newAmenity = new Amenity();
            $newAmenity->name = $amenitiesNames[$i];
            $newAmenity->save();
        }
    }
}
