<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;

use App\Models\Message;
use App\Models\Apartment;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartmentsIds = Apartment::pluck('id')->toArray();

        // $bodiesList = ['Sono interessata al vostro appartamento. Mi potrebbe inviare delle ulteriori informazioni per favore?', '', ''];

        for ($i = 0 ; $i < 50 ; $i++){

            $newMessage = new Message();
            
            $newMessage->apartment_id = Arr::random($apartmentsIds);
            $newMessage->name = $faker->name();
            $newMessage->email = $faker->safeEmail();
            $newMessage->body = $faker->paragraph(2, false);
            // $newMessage->body = '$bodiesList[$i]';

            $newMessage->save();
        }
    }
}
