<?php

use Illuminate\Database\Seeder;
use App\Concert;

class RepresentationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $representations = [
            [
                'concert_id'=>1,
                'moment'=>'2021-10-13 13:00',
            ],
            [
                'concert_id'=>1,
                'moment'=>'2021-11-14 13:00',
            ],
            [
                'concert_id'=>1,
                'moment'=>'2021-11-15 13:00',
            ],
            [
                'concert_id'=>1,
                'moment'=>'2021-11-16 13:00',
            ],
            [
                'concert_id'=>1,
                'moment'=>'2021-11-17 13:00',
            ]
        ];
        
        //Insértion des données dans la table
        foreach ($representations as $representation) {

            $concert = Concert::firstWhere('id',$representation['concert_id']);

            DB::table('representations')->insert([
                'concert_id' => $concert->id,
                'prix' => rand(20,60),
                'moment' => $representation['moment'],
            ]);
        }
    }
}
