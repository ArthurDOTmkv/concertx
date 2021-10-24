<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('user_id');     
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('representation_id');
            $table->integer('prix');
            $table->string('paymentIntentId')->unique()->nullable();   
            $table->dateTime('paymentCreatedAt')->nullable();
            $table->timestamps();  
        });

        Schema::table('carts', function (Blueprint $table)
        {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->foreign('representation_id')
                ->references('id')
                ->on('representations')
                ->onDelete('cascade');

            $table->foreign('place_id')
                ->references('id')
                ->on('places')
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
        Schema::dropIfExists('cart');
    }
}
