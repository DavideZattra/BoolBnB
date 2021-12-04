<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $admin = new User();
        $admin->name = 'admin';
        $admin->surname = 'admin';
        $admin->email = 'test@test.com';
        $admin->profile_picture = $faker->imageUrl(640, 480);
        $admin->birth_date = '1994-01-07';
        $admin->password = bcrypt('password');
        $admin->save();

        for( $i = 0; $i < 15; $i++){
            $newUser = new User();
             
            $newUser->name = $faker->firstName();
            $newUser->surname = $faker->lastName();
            $newUser->email = $faker->safeEmail();
            $newUser->profile_picture = $faker->imageUrl(640, 480);
            $newUser->birth_date = $faker->date('Y-m-d');;
            $newUser->password = bcrypt($newUser->name . $newUser->surname);
            $newUser->save();
        }
    }
}
