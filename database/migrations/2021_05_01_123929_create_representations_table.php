<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('concert_id');
            $table->dateTime('moment');
            $table->timestamps();
        });
        
        //Clé étrangère
        Schema::table('representations', function (Blueprint $table)
        {
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
        Schema::dropIfExists('representations');
    }
}
