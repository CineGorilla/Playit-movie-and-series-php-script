<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectorsItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directors_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('items_id')->unsigned();
            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('directors_id')->unsigned();
            $table->foreign('directors_id')->references('id')->on('directors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('directors_items');
    }
}
