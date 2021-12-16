<?php

use App\Models\SponsorApartment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            UsersTableSeeder::class,
            AmenitiesTableSeeder::class,
            SponsorTableSeeder::class,
            ApartmentsTableSeeder::class,
            MessageTableSeeder::class,
            AddressesTableSeeder::class,
            ViewsTableSeeder::class,
            SponsorApartmentsTableSeeder::class,
        ]);


    }

}