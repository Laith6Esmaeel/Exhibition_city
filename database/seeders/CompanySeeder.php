<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyInformation;
use App\Models\Department;
use App\Models\User;
use App\utils\imageupload;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $admins = User::where('status', 'admin')->get();
        $departments = Department::all();
        foreach ($admins as $admin) {
            foreach ($departments as $department) {
                for ($i = 0; $i < 3; $i++) {
                    $imageName = 'Untitled.jpg';
                    $imagePath = public_path('images/'.$imageName);
                    $company = CompanyInformation::create([
                        'user_id' => $admin->id,
                        'department' => $department->name_department,
                        'company_logo' => $imageName,
                        'company_name' => $faker->company,
                        'company_address' => $faker->address,
                        'company_email' => $faker->companyEmail,
                        'bio' => $faker->text,
                        'facebook' => $faker->url,
                        'admission' => 'accepted',
                    ]);
                    $department->companies()->attach($company->id, [
                        'department_id' => $department->id,
                    ]);
                }
            }
        }
    }
}