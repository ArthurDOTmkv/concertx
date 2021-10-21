<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentationPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representation_places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('representation_id');
            $table->timestamps();
        });
        
         //Clés étrangères
        Schema::table('representation_places', function (Blueprint $table)
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
        Schema::dropIfExists('representation_places');
    }
}
