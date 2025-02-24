<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorsItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actors_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('items_id')->unsigned();
            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('actors_id')->unsigned();
            $table->foreign('actors_id')->references('id')->on('actors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actors_items');
    }
}
