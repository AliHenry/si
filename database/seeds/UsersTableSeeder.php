<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@gmail.com',
            'name' => 'Aliyu',
            'role' => 'admin',
            'password' => bcrypt('secret')
        ]);

        User::create([
            'email' => 'shane@laraspace.in',
            'name' => 'Shane White',
            'role' => 'user',
            'password' => bcrypt('hank@123')
        ]);

        User::create([
            'email' => 'adam@laraspace.in',
            'name' => 'Adam David',
            'role' => 'user',
            'password' => bcrypt('jesse@123')
        ]);
    }
}
