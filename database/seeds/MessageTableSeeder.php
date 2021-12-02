<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\Message;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $bodiesList = ['Sono interessata al vostro appartamento. Mi potrebbe inviare delle ulteriori informazioni per favore?', '', ''];

        for ($i = 0 ; $i < 10 ; $i++){

            $newMessage = new Message();
            
            $newMessage->name = $faker->name();
            $newMessage->email = $faker->safeEmail();
            $newMessage->body = $faker->paragraph(2, false);
            // $newMessage->body = '$bodiesList[$i]';

            $newMessage->save();
        }
    }
}
