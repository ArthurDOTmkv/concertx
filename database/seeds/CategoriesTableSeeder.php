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
            'nom' => 'Chanson',
            'slug' => 'chanson'
        ]);
        
        Categorie::create([
            'nom' => 'Musique',
            'slug' => 'musique'
        ]);
        
        Categorie::create([
            'nom' => 'Cirque',
            'slug' => 'cirque'
        ]);
        
        Categorie::create([
            'nom' => 'Film',
            'slug' => 'film'
        ]);
    }
}
