<?php

use Illuminate\Database\Seeder;
use App\Portfolio;

class PortfolioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portfolios')->insert([
            [
                'user_id'           => 1,
                'title'      => '【緊急】自社のHP制作',
            ],
            [
                'user_id'           => 2,
                'title'      => '探偵事務所・GPS（発信機）レンタル　ＥＣサイト作成',
            ],
            [
                'user_id'           => 2,
                'title'      => '探偵事務所・GPS（発信機）レンタル　ＥＣサイト作成',
            ],
            [
                'user_id'           => 3,
                'title'      => 'AmazonアソシエイトAPI取得のブログ制作およびAPI取得代行　',
            ],
            [
                'user_id'           => 4,
                'title'      => 'ECサイトとコーポレーションサイトを合体させたホームページ',
            ],
            [
                'user_id'           => 5,
                'title'      => 'デイサービスのホームページ作成＆アップロード',
            ],
            [
                'user_id'           => 6,
                'title'      => '2サイト分のECサイトデザイン',
            ],
            
        ]);
    }
}
