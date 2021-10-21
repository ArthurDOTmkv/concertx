<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('paymentIntentId')->unique();
            $table->integer('montant');
            $table->dateTime('paymentCreatedAt');
            $table->text('concerts');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('representation_place_id');
            $table->timestamps();
        });
        
        //Clé étrangère
        Schema::table('commandes', function (Blueprint $table)
        {
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('cascade');
            
            $table->foreign('represenation_place_id')
                ->references('id')
                ->on('representaion_place')
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
        Schema::dropIfExists('commandes');
    }
}
