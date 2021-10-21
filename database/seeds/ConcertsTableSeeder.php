<?php

use App\Concert;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ConcertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        
        for($i=0; $i<20; $i++)
        {
            Concert::create([
               'titre' => $faker->sentence(6, false),
               'slug' => $faker->slug,
               'soustitre' => $faker->sentence(15, false),
               'description' => $faker->text,
               'prix' => $faker->numberBetween(30, 120) * 100,          //Stocker le prix en centimes dans la DB (Best practice)
               'image' => 'https://via.placeholder.com/200x250'
            ])->categories()->attach([
                rand(1, 5),
            ]);
        }
    }
}
