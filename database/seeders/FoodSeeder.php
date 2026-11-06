<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $barbeque = FoodCategory::where('name', 'Barbeque')->first()->id;
        $pizza = FoodCategory::where('name', 'Pizza')->first()->id;
        $pasta = FoodCategory::where('name', 'Pasta')->first()->id;
        $burger = FoodCategory::where('name', 'Burger')->first()->id;
        $salad = FoodCategory::where('name', 'Salad')->first()->id;

        function imageHash($filename) {
            $path = public_path('assets/images/' . $filename);

            return File::exists($path) ? md5_file($path) : null;
        }

        Food::insert([
            [
                'name' => 'Grilled Chicken',
                'description' => 'Juicy grilled chicken with spices',
                'price' => 9.50,
                'image' => 'grilled_chicken.jpg',
                'image_hash' => imageHash('grilled_chicken.jpg'),
                'food_category_id' => $barbeque,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'BBQ Ribs',
                'description' => 'Slow-cooked ribs with BBQ sauce',
                'price' => 14.00,
                'image' => 'bbq_ribs.jpg',
                'image_hash' => imageHash('bbq_ribs.jpg'),
                'food_category_id' => $barbeque,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Margherita',
                'description' => 'Classic pizza with tomato and mozzarella',
                'price' => 7.50,
                'image' => 'margherita.jpg',
                'image_hash' => imageHash('margherita.jpg'),
                'food_category_id' => $pizza,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Capricciosa',
                'description' => 'Classic pizza with tomato, mozzarella and salami',
                'price' => 8.50,
                'image' => 'capricciosa.jpg',
                'image_hash' => imageHash('capricciosa.jpg'),
                'food_category_id' => $pizza,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pepperoni',
                'description' => 'Pizza with pepperoni and cheese',
                'price' => 8.50,
                'image' => 'pepperoni.jpg',
                'image_hash' => imageHash('pepperoni.jpg'),
                'food_category_id' => $pizza,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Carbonara',
                'description' => 'Pasta with creamy sauce and bacon',
                'price' => 8.00,
                'image' => 'carbonara.jpg',
                'image_hash' => imageHash('carbonara.jpg'),
                'food_category_id' => $pasta,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bolognese',
                'description' => 'Pasta with meat sauce',
                'price' => 8.50,
                'image' => 'bolognese.jpg',
                'image_hash' => imageHash('bolognese.jpg'),
                'food_category_id' => $pasta,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Classic Burger',
                'description' => 'Beef burger with lettuce and tomato',
                'price' => 7.00,
                'image' => 'classic_burger.jpg',
                'image_hash' => imageHash('classic_burger.jpg'),
                'food_category_id' => $burger,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cheeseburger',
                'description' => 'Burger with melted cheese',
                'price' => 7.50,
                'image' => 'cheeseburger.jpg',
                'image_hash' => imageHash('cheeseburger.jpg'),
                'food_category_id' => $burger,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Chicken Burger',
                'description' => 'Chicken burger with fries',
                'price' => 8.50,
                'image' => 'chickenburger.jpg',
                'image_hash' => imageHash('chickenburger.jpg'),
                'food_category_id' => $burger,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Salad with chicken, croutons and dressing',
                'price' => 6.50,
                'image' => 'caesar.jpg',
                'image_hash' => imageHash('caesar.jpg'),
                'food_category_id' => $salad,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Greek Salad',
                'description' => 'Fresh salad with feta cheese and olives',
                'price' => 6.00,
                'image' => 'greek.jpg',
                'image_hash' => imageHash('greek.jpg'),
                'food_category_id' => $salad,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
