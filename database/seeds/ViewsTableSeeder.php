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

        foreach ($apartmentIds as $item) {
            
            for( $i = 0; $i < rand(1000, 3500); $i++ ){
    
                $newView = new View();
    
                $newView->apartment_id = $item;
                $newView->ip_address = $faker->ipv4();
                $newView->visited_at = $faker->dateTimeBetween('-2 years', '+6 days');
                
                $newView->save();
            };
        }
    }
}
