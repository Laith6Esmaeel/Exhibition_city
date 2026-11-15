<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // تأكد من استيراد نموذج User
use App\Models\Product; // تأكد من استيراد نموذج Product
use App\Models\Favourite; // تأكد من استيراد نموذج Favourite
use Faker\Factory as Faker;

class FavouriteSeeder extends Seeder
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

        // تحقق مما إذا كانت هناك مستخدمين ومنتجات متاحة
        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->info('No users or products found. Please create users and products before seeding favourites.');
            return;
        }

        foreach ($users as $user) {
            // اختر عدد عشوائي من المنتجات المفضلة لكل مستخدم (مثلاً 1 إلى 5)
            $favouriteCount = $faker->numberBetween(1, 5);
            $favouriteProducts = $products->random($favouriteCount)->pluck('id');

            foreach ($favouriteProducts as $productId) {
                Favourite::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                ]);
            }
        }
    }
}
