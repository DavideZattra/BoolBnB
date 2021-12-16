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
        $sponsorPrices = ['2.99', '5.99', '9.99'];
        $sponsorDurations = ['24', '72', '144'];

        for ($i = 0 ; $i < count($sponsorNames); $i++){
            $newSponsor = new Sponsor();
            $newSponsor->name = $sponsorNames[$i];
            $newSponsor->price = $sponsorPrices[$i];
            $newSponsor->duration = $sponsorDurations[$i];
            $newSponsor->save();
        }
    }
}
