<?php

use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Création des places
        /*
         * Premier for gère les rangères
         * Deuxième for gère les colonnes
         */
        for ($x = 0; $x<10; $x++) {
            for ($y = 0; $y<15; $y++){
                DB::table('places')->insert([
                    'rangee' => $x+1,
                    'colonne' => $y+1
                ]);
            }
        }
    }
    
}
