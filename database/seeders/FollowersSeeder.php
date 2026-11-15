<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CompanyInformation;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FollowersSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();
        $companies = CompanyInformation::all();


        if ($users->isEmpty() || $companies->isEmpty()) {
            $this->command->info('No users or companies found. Please create users and companies before seeding followers.');
            return;
        }
        $companyIds = array_intersect(range(1, 25), $companies->pluck('id')->toArray());

        foreach ($users as $user) {

            $followedCompanyIds = array_rand(array_flip($companyIds), rand(1, 3));

            if (!is_array($followedCompanyIds)) {
                $followedCompanyIds = [$followedCompanyIds];
            }

            foreach ($followedCompanyIds as $companyId) {
                DB::table('followers')->insert([
                    'user_id' => $user->id,
                    'company_information_id' => $companyId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
