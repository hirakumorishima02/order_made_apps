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
        DB::table('subscribes')->insert([
            [
                'user_id'           => 1,
                'job_id'      => 1,
                'status'          => 3,
                'message'       => 'よろしくお願いします。',
            ],
            [
                'user_id'           => 1,
                'job_id'      => 2,
                'status'          => 2,
                'message'       => 'よろしくお願いします。',
            ],
            [
                'user_id'           => 2,
                'job_id'      => 3,
                'status'          => 1,
                'message'       => 'よろしくお願いします。',
            ],
            [
                'user_id'           => 2,
                'job_id'      => 4,
                'status'          => 4,
                'message'       => 'よろしくお願いします。',
            ],
            [
                'user_id'           => 3,
                'job_id'      => 5,
                'status'          => 3,
                'message'       => 'よろしくお願いします。',
            ],
            [
                'user_id'           => 3,
                'job_id'      => 6,
                'status'          => 2,
                'message'       => 'よろしくお願いします。',
            ],
            [
                'user_id'           => 4,
                'job_id'      => 7,
                'status'          => 1,
                'message'       => 'よろしくお願いします。',
            ],
            [
                'user_id'           => 5,
                'job_id'      => 1,
                'status'          => 4,
                'message'       => 'よろしくお願いします。',
            ],
            [
                'user_id'           => 6,
                'job_id'      => 2,
                'status'          => 3,
                'message'       => 'よろしくお願いします。',
            ],
            [
                'user_id'           => 7,
                'job_id'      => 3,
                'status'          => 2,
                'message'       => 'よろしくお願いします。',
            ],
            [
                'user_id'           => 1,
                'job_id'      => 4,
                'status'          => 1,
                'message'       => 'よろしくお願いします。',
            ],
            
        ]);
    }
}
