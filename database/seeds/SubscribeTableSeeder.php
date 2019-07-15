<?php

use Illuminate\Database\Seeder;
use App\Subscribe;

class SubscribeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Subscribe::class, 10)->create();
    }
}
