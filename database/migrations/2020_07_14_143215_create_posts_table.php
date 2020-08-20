<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('post_id');
            $table->bigInteger('author_id')->unsigned(); //может быть целым положительным числом не меньше 0
            $table->string('title');
            $table->string('short_title');
            $table->string('img')->nullable();
            $table->text('descr');
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
            //foreign - внешний ключ,
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
