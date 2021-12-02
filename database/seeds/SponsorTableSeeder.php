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
        $sponsorPrices = ['19,99', '24,99', '29,99'];
        $sponsorDurations = ['1', '3', '6'];

        for ($i = 1 ; $i <= 3; $i++){
            $newSponsor = new Sponsor();
            $newSponsor->name = $sponsorNames[$i-1];
            $newSponsor->price = $sponsorPrices[$i-1];
            $newSponsor->duration = $sponsorDurations[$i-1];
            $newSponsor->save();
        }
    }
}
