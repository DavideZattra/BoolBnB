<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\View;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for( $i = 0; $i < 20; $i++ ){

            $newView = new View();

            $newView->ip_adress = $faker->ipv4();
            $newView->visited_at = $faker->dateTime();
            
            $newView->save();
        };
    }
}
