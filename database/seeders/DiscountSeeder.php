<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // تأكد من استيراد نموذج Product
use App\Models\Discount; // تأكد من استيراد نموذج Discount
use Faker\Factory as Faker;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // استرجاع جميع المنتجات
        $products = Product::all();

        // تحقق مما إذا كانت هناك منتجات متاحة
        if ($products->isEmpty()) {
            $this->command->info('No products found. Please create products before seeding discounts.');
            return;
        }

        foreach ($products as $product) {
            Discount::create([
                'product_id' => $product->id,
                'discount' => $faker->numberBetween(5, 50) . '%', // خصم عشوائي بين 5% و 50%
                'expiry_time' => $faker->dateTimeBetween('now', '+1 year'), // تاريخ انتهاء عشوائي في المستقبل
            ]);
        }
    }
}
