<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlacesToConcertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * On rajoute le champ 'places' à la table concerts pour la salle de spectacle
         * qui, par défaut, contient 300 places
         */
        Schema::table('concerts', function (Blueprint $table) {
            $table->unsignedInteger('places')->after('prix')->default(300);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('concerts', function (Blueprint $table) {
            //
        });
    }
}
