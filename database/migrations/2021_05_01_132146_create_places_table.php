<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('colonne');
            $table->char('rangee');
            $table->unsignedBigInteger('zone_id');
            $table->timestamps();
        });
        
         //Clés étrangères
        Schema::table('places', function (Blueprint $table)
        {
            $table->foreign('zone_id')
                ->references('id')
                ->on('zones')
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
        Schema::dropIfExists('places');
    }
}
