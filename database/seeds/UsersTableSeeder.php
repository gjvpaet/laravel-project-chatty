<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            DB::table('users')->insert([
                'email' => $faker->email(),
                'username' => $faker->userName(),
                'first_name' => $faker->firstName($gender = 'male'|'female'),
                'last_name' => $faker->lastName(),
                'location' => $faker->address(),
                'password' => bcrypt($faker->password()),
                'created_at' => $faker->dateTimeThisYear($max = 'now'),
                'updated_at' => $faker->dateTimeThisYear($max = 'now')
            ]);
        }
    }
}
