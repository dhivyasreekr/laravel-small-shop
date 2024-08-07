<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        User::factory()->create([
            'name' => 'dhivi',
            'email' => 'dhivi@gmail.com',
            'password' => Hash::make('dhivi'),
        ]);


        $brands = [
            ['name' => 'Apple'],
            ['name' => 'hp'],
            ['name' => 'Hatsun'],
            ['name' => 'Classmate'],
            ['name' => 'Nestle'],
            ['name' => 'A2B'],
        ];

        foreach ($brands as $row){
            Brand::create($row);
        }

        $categories = [
            ['name' => 'Fresh Produce'],
            ['name' => 'Dairy and Eggs'],
            ['name' => 'Meat and Seafood'],
            ['name' => 'Bakery'],
            ['name' => 'Pantry Staples'],
            ['name' => 'Beverages'],
            ['name' => 'Frozen Foods'],
            ['name' => 'Snacks'],
            ['name' => 'Health and Wellness'],
            ['name' => 'Household Supplies'],
            ['name' => 'Personal Care'],
            ['name' => 'Baby Products'],
            ['name' => 'Pet Supplies'],
            ['name' => 'International Foods'],
        ];

        foreach ($categories as $row){
            Category::create($row);
        }

        $products = [
            [
                'category_id' => 1,
                'brand_id' => 6,
                'name' => 'Apple',
                'description' => 'abcd',
                'price' => 100,
                'qty' => 150,
                'alert_stock' => 10,
            ],
            [
                'category_id' => 2,
                'brand_id' => 6,
                'name' => 'Eggs',
                'description' => 'xyz',
                'price' => 6,
                'qty' => 500,
                'alert_stock' => 10,
            ],
            
        ];

        foreach ($products as $row){
            Product::create($row);
        }
    }
}
