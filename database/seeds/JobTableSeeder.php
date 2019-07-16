<?php

use Illuminate\Database\Seeder;
use App\Job;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            [
                'user_id'           => 1,
                'title'      => 'Webマッチングサービスの決済システムの導入',
                'content'          => '現在当社で運営しておりますWebマッチングサービスの
                                        決済部分の導入をお願いできればと思います。
                                        以前はStripe様を利用しておりましたが現在は銀行振込のみで対応しており
                                        今回テレコムクレジット様のシステムを利用予定となります。
                                        テレコムクレジット様とは既に契約を締結しており
                                        実装フェーズにありますので経験者であればなお優遇させていただきます。',
                'wish_at'       => '2019-09-23',
                'job_photo'      => '/images/light.jpg',
                'money' => rand(1000, 200000),
            ],
            [
                'user_id'           => 1,
                'title'      => 'イベント集客サービスのシステム開発のご依頼',
                'content'          => 'WordPress製のシステムをLaravel製の既存システムを使って置き換える開発となります。
                                        実装の大半は既存コードが流用可能な内容となっております。
                                        フロントエンド移植やデータ移行、仕様から検討すべき機能が数点ございますので、
                                        既存実装のソースコードを確認しての調査、および仕様の提案が可能な方を希望致します。',
                'wish_at'       => '2019-09-23',
                'job_photo'      => '/images/light.jpg',
                'money' => rand(1000, 200000),
            ],
            [
                'user_id'           => 2,
                'title'      => '【副業/リモート可】急成長中の最先端技術が学べる「プログラミングスクール」の講師募集!!',
                'content'          => '急成長中のプログラミングスクール講師の募集です！
                                        新規事業を続々と展開しCrowd Worksと提携している会社が手がける、
                                        日本と世界のあり方を変えていくサービスをスピード感を持って一緒に作っていけるエンジニアを募集します。
                                        副業やリモートからの参画も可能です！詳細はご面談時にお話させていただきますので、
                                        面白そうと思ったらまずはご応募ください。',
                'wish_at'       => '2019-09-23',
                'job_photo'      => '/images/light.jpg',
                'money' => rand(1000, 200000),
            ],
            [
                'user_id'           => 3,
                'title'      => '【InDesign】【DTP】デザインはすでにあり。ブログ100記事の本文(画像、テキスト)流し込み',
                'content'          => 'クリエイティブなスクロールエフェクトやスライダーなどでコーディングをお願いできる方を探しています。
                                        10P程度のサイトです。予算がないのですが8月末まででCSSやJSによるクリエイティブなコーディング可能な方、助けてください！',
                'wish_at'       => '2019-09-23',
                'job_photo'      => '/images/light.jpg',
                'money' => rand(1000, 200000),
            ],
            [
                'user_id'           => 3,
                'title'      => '【YDN出稿用バナーの作成】福岡エリアでマンション管理業者を探している人向けのバナー作成',
                'content'          => 'MakeShopの新規案件コーディングのPCとスマホ別にコーディングができる方を探しております。経験者を優遇させて頂きます。',
                'wish_at'       => '2019-09-23',
                'job_photo'      => '/images/light.jpg',
                'money' => rand(1000, 200000),
            ],
            [
                'user_id'           => 4,
                'title'      => 'EC-CUBEシステム改修【２案件】',
                'content'          => '既存のコーディングデータがあり、特定のサイトのSP版にあわせていただけますでしょうか。',
                'wish_at'       => '2019-09-23',
                'job_photo'      => '/images/light.jpg',
                'money' => rand(1000, 200000),
            ],
            [
                'user_id'           => 4,
                'title'      => '【YDN出稿用バナーの作成】伊豆や伊東、伊豆高原の別荘等の不動産を取り扱う会社のバナー作成',
                'content'          => '某メディア媒体で、記事ページを作成しています。デザインファイルをお渡し、そのコーディングをお願いできる方を探しています。
                                        定型のテンプレートがあるため基本的には、画像とテキストの流しこみ作業になりますが場合によって、レイアウトの微調整、画像のトリミングが必要になります。',
                'wish_at'       => '2019-09-23',
                'job_photo'      => '/images/light.jpg',
                'money' => rand(1000, 200000),
            ],
            [
                'user_id'           => 5,
                'title'      => '剪定・伐採・芝刈り・雑草対策などを業者に依頼したことがある方限定の簡単作業',
                'content'          => '
                                        はじめまして。
                                        現在フリーランスでWeb受託制作業務を行っていますが、主にコーディング実装部分でキャパオーバーな状態です。
                                        そのため、コーディング実装できる方を募集しています。
                                        案件は多数ありまして、クライアントさんには事前承諾いただいた後に入っていただこうと思っています。
                                        下層ページのみ、Wordpressのみ、なども相談できますので、応募時にお知らせください。',
                'wish_at'       => '2019-09-23',
                'job_photo'      => '/images/light.jpg',
                'money' => rand(1000, 200000),
            ],
            [
                'user_id'           => 6,
                'title'      => '【外壁塗装ショールーム店舗看板!!】',
                'content'          => 'ランディングページ、商品ページの制作や改善を中心に、ECサイトのコーディングやデザインを長期的にお手伝い頂ける方を募集します。完全在宅でコンスタントにお仕事したい方に最適です！
',
                'wish_at'       => '2019-09-23',
                'job_photo'      => '/images/light.jpg',
                'money' => rand(1000, 200000),
            ],
            [
                'user_id'           => 7,
                'title'      => 'ネットショップ運営コンサルタントのアシスタント業務お願いします。　一日2-3時間の対応',
                'content'          => 'CMSを使ってデザインを当てはめる作業になります。すでに出来上がっているデザインからコーディングしていただきます。',
                'wish_at'       => '2019-09-23',
                'job_photo'      => '/images/light.jpg',
                'money' => rand(1000, 200000),
            ],
            
        ]);
    }
}
