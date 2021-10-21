<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtisteConcertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artiste_concert', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('artiste_id');
            $table->unsignedBigInteger('concert_id');
            $table->timestamps();
        });
        
        //Clés étrangères
        Schema::table('artiste_concert', function (Blueprint $table)
        {
            $table->foreign('artiste_id')
                ->references('id')
                ->on('artistes')
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
        Schema::dropIfExists('artiste_concert');
    }
}
