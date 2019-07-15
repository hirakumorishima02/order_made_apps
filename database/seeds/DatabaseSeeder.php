<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            JobTableSeeder::class,
            PortfolioTableSeeder::class,
            UserInfoTableSeeder::class,
            SubscribeTableSeeder::class
        ]);
    }
}
