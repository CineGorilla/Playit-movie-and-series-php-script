<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('tmdb_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('type');
            $table->string('tagline')->nullable();
            $table->string('poster')->nullable();
            $table->string('backdrop')->nullable();
            $table->longText('description')->nullable();
            $table->string('trailer')->nullable();
            $table->string('duration')->nullable();
            $table->string('rating')->nullable();
            $table->string('release_date')->nullable();
            $table->longText('player')->nullable();
            $table->longText('download')->nullable();
            $table->string('views');
            $table->boolean('visible');
            $table->boolean('feature');
            $table->boolean('recommended');
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
        Schema::dropIfExists('items');
    }
}
