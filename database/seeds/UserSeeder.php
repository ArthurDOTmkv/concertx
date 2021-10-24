<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'arthur',
            'email' => 'arthur@concertx.com',
            'password' => Hash::make('password')
        ]);
    }
}
