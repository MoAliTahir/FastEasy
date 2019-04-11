<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoitureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voiture', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_partenaire')->unsigned();
            $table->enum('type',['Coupé','Familiale','Cabriolet','Pickup','4x4','sport']);
            $table->string('marque');
            $table->string('modele');
            $table->string('cheminImages');
            $table->timestamps();
        });

        Schema::table('voiture', function (Blueprint $table){
            $table->foreign('id_partenaire')->references('id')->on('partenaire')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voiture');
    }
}
