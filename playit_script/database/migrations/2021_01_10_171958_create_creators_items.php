<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatorsItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creators_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('items_id')->unsigned();
            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('creators_id')->unsigned();
            $table->foreign('creators_id')->references('id')->on('creators')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creators_items');
    }
}
