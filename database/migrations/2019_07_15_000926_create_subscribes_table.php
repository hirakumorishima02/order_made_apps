<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); //応募主のid
            $table->unsignedBigInteger('job_id'); //仕事のid
            $table->integer('status'); //1 ->応募・ 2->決定・3->納品完了・4->検収完了の4つの状態
            $table->longText('message'); //応募メッセージ
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
                  
            $table->foreign('job_id')
                  ->references('id')
                  ->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribes');
    }
}
