<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Thêm sản phẩm vào danh mục 1 (Điện thoại)
        Product::create([
            'category_id' => 1,
            'name' => 'iPhone 15 Pro Max',
            'price' => 29900000,
            'description' => 'Mẫu điện thoại cao cấp nhất của Apple',
        ]);

        // Thêm sản phẩm vào danh mục 2 (Laptop)
        Product::create([
            'category_id' => 2,
            'name' => 'MacBook Air M3',
            'price' => 27900000,
            'description' => 'Laptop mỏng nhẹ, pin trâu',
        ]);
    }
}