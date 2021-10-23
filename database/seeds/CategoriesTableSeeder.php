<?php

use App\Categorie;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::create([
            'nom' => 'Théâtre',
            'slug' => 'theatre'
        ]);
        
        Categorie::create([
            'nom' => 'Nightclub',
            'slug' => 'nightclub'
        ]);
        
        Categorie::create([
            'nom' => 'Musique',
            'slug' => 'musique'
        ]);
        
        Categorie::create([
            'nom' => 'Comédie',
            'slug' => 'comedie'
        ]);
        
        Categorie::create([
            'nom' => 'Film',
            'slug' => 'film'
        ]);
    }
}
