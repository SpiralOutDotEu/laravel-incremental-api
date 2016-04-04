<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'name' => 'user',
        ]);
    }
}
