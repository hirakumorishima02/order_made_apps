<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); //ユーザーID
            $table->unsignedBigInteger('job_id'); //お気に入り登録した仕事のID
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
        Schema::dropIfExists('favorites');
    }
}
