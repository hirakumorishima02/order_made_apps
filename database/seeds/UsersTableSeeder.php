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
        DB::table('users')->insert([
            [
                'name'           => 'user01',
                'email'          => 'ujinchu@amail.com',
                'password'       => Hash::make('password'),
                'remember_token' => str_random(10),
            ],
            [
                'name'           => 'user02',
                'email'          => 'ujinchu@bmail.com',
                'password'       => Hash::make('password'),
                'remember_token' => str_random(10),
            ],
            [
                'name'           => 'user03',
                'email'          => 'ujinchu@cmail.com',
                'password'       => Hash::make('password'),
                'remember_token' => str_random(10),
            ],
            [
                'name'           => 'user04',
                'email'          => 'ujinchu@dmail.com',
                'password'       => Hash::make('password'),
                'remember_token' => str_random(10),
            ],
            [
                'name'           => 'user05',
                'email'          => 'ujinchu@email.com',
                'password'       => Hash::make('password'),
                'remember_token' => str_random(10),
            ],
            [
                'name'           => 'user06',
                'email'          => 'ujinchu@hmail.com',
                'password'       => Hash::make('password'),
                'remember_token' => str_random(10),
            ],
            [
                'name'           => 'user07',
                'email'          => 'ujinchu@imail.com',
                'password'       => Hash::make('password'),
                'remember_token' => str_random(10),
            ],
            
        ]);
    }
}
