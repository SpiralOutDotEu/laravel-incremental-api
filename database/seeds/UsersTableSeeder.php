<?php

use App\User;
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
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
            'email' => 'master@master.com',
            'password' => Hash::make('master'),
            'name' => 'master',
        ]);
    }
}
