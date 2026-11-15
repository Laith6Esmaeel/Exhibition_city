<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // تأكد من استيراد نموذج Product
use App\Models\Trend; // تأكد من استيراد نموذج Trend
use Faker\Factory as Faker;

class TrendSeeder extends Seeder
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
            $this->command->info('No products found. Please create products before seeding trends.');
            return;
        }

        // اختر عدد عشوائي من المنتجات لإضافتها إلى trends (مثلاً 10)
        foreach ($products->random(10) as $product) {
            Trend::create([
                'product_id' => $product->id,
                'admission' => 'accepted'
            ]);
        }
    }
}
