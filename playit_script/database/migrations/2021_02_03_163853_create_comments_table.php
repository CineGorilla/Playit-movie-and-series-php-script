<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('post_id');
            $table->integer('season_id')->nullable();
            $table->integer('episode_id')->nullable();
            $table->string('user_name');
            $table->string('email');
            $table->longText('comment');
            $table->integer('type');
            $table->boolean('approve')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
