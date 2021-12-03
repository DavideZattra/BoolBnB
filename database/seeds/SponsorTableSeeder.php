<?php

use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorNames = ['Standard', 'Gold', 'Platinum'];
        $sponsorPrices = ['19.99', '24.99', '29.99'];
        $sponsorDurations = ['1', '3', '6'];

<<<<<<< HEAD
        for ($i = 1 ; $i <= 3; $i++){

            $newSponsor = new Sponsor();
            
            $newSponsor->name = $sponsorNames[$i-1];
            $newSponsor->price = $sponsorPrices[$i-1];
            $newSponsor->duration = $sponsorDurations[$i-1];

=======
        for ($i = 0 ; $i < count($sponsorNames); $i++){
            $newSponsor = new Sponsor();
            $newSponsor->name = $sponsorNames[$i];
            $newSponsor->price = $sponsorPrices[$i];
            $newSponsor->duration = $sponsorDurations[$i];
>>>>>>> amenity
            $newSponsor->save();
        }
    }
}
