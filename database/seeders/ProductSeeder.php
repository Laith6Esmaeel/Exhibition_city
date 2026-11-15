<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\CompanyInformation;
use App\utils\imageupload;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();

        $companies = CompanyInformation::count();

        for ($i = 0; $i < 20; $i++) {
            $imageName = 'Untitled.jpg';
            $imagePath = public_path('images/'.$imageName);
            Product::create([
                'company_id' => $faker->numberBetween(1, 25),
                'image' => $imageName,
                'name' => $faker->word(),
                'price' => $faker->randomFloat(2, 1, 100),
                'quantity' => $faker->numberBetween(1, 100),
                'data' => json_encode(['description' => $faker->sentence()]),
            ]);
        }
    }
}