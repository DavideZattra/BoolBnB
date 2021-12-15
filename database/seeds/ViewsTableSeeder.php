<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;

use App\Models\View;
use App\Models\Apartment;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartmentIds = Apartment::pluck('id')->toArray();

        for( $i = 0; $i < 20; $i++ ){

            $newView = new View();

            $newView->apartment_id = Arr::random($apartmentIds);
            $newView->ip_address = $faker->ipv4();
            $newView->visited_at = $faker->dateTime();
            
            $newView->save();
        };
    }
}
