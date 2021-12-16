<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;
use Carbon\Carbon;

use App\Models\Apartment;
use App\Models\Sponsor;
use App\Models\SponsorApartment;


class SponsorApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartmentids = Apartment::pluck('id')->toArray();
        $sponsorids = Sponsor::pluck('id')->toArray();

        for ($i=0; $i < 30; $i++) {
            $newSponsorApartment = new SponsorApartment;
            $newSponsorApartment->apartment_id = Arr::random($apartmentids);
            $newSponsorApartment->sponsor_id = Arr::random($sponsorids);
            $newSponsorApartment->transaction_id = '64sad913189sad';
            $newSponsorApartment->start = $faker->dateTimeBetween('-300 days','50 days');
            $newSponsorApartment->end = $faker->dateTimeBetween('-300 days','50 days');        

            $newSponsorApartment->save();
        }
    }
}