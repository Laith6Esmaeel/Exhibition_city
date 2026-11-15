<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();


        $users = User::all();


        if ($users->isEmpty()) {
            $this->command->info('No users found. Please create users before seeding profiles.');
            return;
        }


        foreach ($users as $user) {
            Profile::create([
                'user_id' => $user->id,
                'address' => $faker->address(),
                'age' => $faker->numberBetween(18, 65),
                'facebook' => $faker->url(),
                'gender' => $faker->randomElement(['male', 'female']),
            ]);
        }
    }
}
