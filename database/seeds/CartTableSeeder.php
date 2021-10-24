<?php

use Illuminate\Database\Seeder;
use App\Cart;

class CartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'user_id' => 1,
                'place_id' => 1,
                'representation_id' => 1,
                'prix' => 100
            ],
            [
                'user_id' => 1,
                'place_id' => 2,
                'representation_id' => 1,
                'prix' => 100
            ],
            [
                'user_id' => 1,
                'place_id' => 4,
                'representation_id' => 1,
                'prix' => 100
            ]
           
        ];
  
        foreach ($products as $key => $value) {
            Cart::create($value);
        }
    }
}
