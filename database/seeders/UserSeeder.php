<?php

namespace Database\Seeders;

use App\Models\BlockedKeyword;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 25; $i++) {
//            User::create([
//                "name" => $faker->name(),
//                "email" => $faker->safeEmail,
//                'password' => Hash::make($faker->password()),
//                "gender" => $faker->randomElement(["male", "female"]),
//                "user_role" => $faker->randomElement(["user", "admin"]),
//                'remember_token' => Str::random(10),
//                'comment' => $faker->text(100),
//                'country' => $faker->country(),
//            ]);

//            BlockedKeyword::create([
//                "keyword" => $faker->word(),
//            ]);
        }
    }
}
