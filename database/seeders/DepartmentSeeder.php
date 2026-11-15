<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use App\utils\imageupload;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $superAdmin = User::where('status', 'super_admin')->first();
        if ($superAdmin) {
            for ($i = 0; $i < 8; $i++) {
                $imageName = 'Untitled.jpg';
                $imagePath = public_path('images/'.$imageName);
                Department::create([
                    'user_id' => $superAdmin->id,
                    'image_department' => $imageName,
                    'name_department' => $faker->word,
                    'number_company' => $faker->randomNumber(5, true),
                ]);
            }
        }
    }
}