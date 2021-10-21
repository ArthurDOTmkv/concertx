<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieConcertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_concert', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('concert_id');
            $table->timestamps();
        });
        
        //Clés étrangères
        Schema::table('categorie_concert', function (Blueprint $table)
        {
            $table->foreign('categorie_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            
            $table->foreign('concert_id')
                ->references('id')
                ->on('concerts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorie_concert');
    }
}
