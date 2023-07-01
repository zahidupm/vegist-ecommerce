<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@vegist.com',
            'password' => bcrypt('123'),
        ]);

        Category::factory(10)->create();

        $this->call(SliderSeeder::class);

        Product::factory(50)->create()->each(function ($product) {
            for ($i = 0; $i < rand(3, 6); $i++) {
                Gallery::create([
                    // 'name' => 'https://source.unsplash.com/random/1040x450/?fruits,drinks&' . rand(2, 421342),
                    'name' => 'https://picsum.photos/600/400/?fruits,drinks&' . rand(2, 421342),
                    'product_id' => $product->id,
                ]);
            }
        });
    }
}
