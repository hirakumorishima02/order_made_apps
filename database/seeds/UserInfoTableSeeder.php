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
        DB::table('user__infos')->insert([
            [
                'user_id'           => 1,
                'profile'      => 'user1です。よろしくお願いします。',
                'photo'          => '/images/avatar.jpg',
                'github'       => 'hirakumorishima01',
                'url'      => 'https://github.com/hirakumorishima02',
            ],
            [
                'user_id'           => 2,
                'profile'      => 'user2です。よろしくお願いします。',
                'photo'          => '/images/avatar.jpg',
                'github'       => 'hirakumorishima02',
                'url'      => 'https://github.com/hirakumorishima02',
            ],
            [
                'user_id'           => 3,
                'profile'      => 'user3です。よろしくお願いします。',
                'photo'          => '/images/avatar.jpg',
                'github'       => 'hirakumorishima03',
                'url'      => 'https://github.com/hirakumorishima02',
            ],
            [
                'user_id'           => 4,
                'profile'      => 'user4です。よろしくお願いします。',
                'photo'          => '/images/avatar.jpg',
                'github'       => 'hirakumorishima04',
                'url'      => 'https://github.com/hirakumorishima02',
            ],
            [
                'user_id'           => 5,
                'profile'      => 'user5です。よろしくお願いします。',
                'photo'          => '/images/avatar.jpg',
                'github'       => 'hirakumorishima05',
                'url'      => 'https://github.com/hirakumorishima02',
            ],
            [
                'user_id'           => 6,
                'profile'      => 'user6です。よろしくお願いします。',
                'photo'          => '/images/avatar.jpg',
                'github'       => 'hirakumorishima06',
                'url'      => 'https://github.com/hirakumorishima02',
            ],
            [
                'user_id'           => 7,
                'profile'      => 'user7です。よろしくお願いします。',
                'photo'          => '/images/avatar.jpg',
                'github'       => 'hirakumorishima07',
                'url'      => 'https://github.com/hirakumorishima02',
            ],
        ]);
    }
}
