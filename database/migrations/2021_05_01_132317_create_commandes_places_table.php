<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes_places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('representation_id');
            $table->timestamps();
        });
        
         //Clés étrangères
        Schema::table('commandes_places', function (Blueprint $table)
        {
            $table->foreign('place_id')
                ->references('id')
                ->on('places')
                ->onDelete('cascade');
            
            $table->foreign('representation_id')
                ->references('id')
                ->on('representations')
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
        Schema::dropIfExists('commandes_places');
    }
}
