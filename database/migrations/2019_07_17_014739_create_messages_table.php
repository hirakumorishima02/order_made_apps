<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('from_user_id'); //メッセージを出したユーザーのID
            $table->unsignedBigInteger('job_id'); //メッセージのやり取りをしている仕事のID
            $table->text('file')->nullable(); //メッセージでやりとりするファイル
            $table->longText('body');
            $table->timestamps();
            
            $table->foreign('from_user_id')
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
        Schema::dropIfExists('messages');
    }
}
