<?php

use Illuminate\Database\Seeder;
use App\User_Info;

class UserInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User_Info::class, 10)->create();
    }
}
