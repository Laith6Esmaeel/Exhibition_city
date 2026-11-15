<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // تأكد من استيراد نموذج User
use App\Models\Product; // تأكد من استيراد نموذج Product
use App\Models\Comment; // تأكد من استيراد نموذج Comment
use App\Models\Comments;
use Faker\Factory as Faker;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // استرجاع جميع المستخدمين والمنتجات
        $users = User::all();
        $products = Product::all();

        // تحقق مما إذا كانت هناك مستخدمون ومنتجات متاحة
        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->info('No users or products found. Please create users and products before seeding comments.');
            return;
        }

        // إضافة تعليقات عشوائية
        foreach (range(1, 50) as $index) { // على سبيل المثال، إضافة 50 تعليقًا
            Comments::create([
                'user_id' => $users->random()->id, // اختيار مستخدم عشوائي
                'product_id' => $products->random()->id, // اختيار منتج عشوائي
                'comment' => $faker->sentence(), // نص التعليق
            ]);
        }
    }
}
