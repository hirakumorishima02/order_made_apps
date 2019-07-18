<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); //ユーザーID
            $table->unsignedBigInteger('follow_user_id'); //フォローしたユーザーのID
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
                  
            $table->foreign('follow_user_id')
                  ->references('id')
                  ->on('users');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
