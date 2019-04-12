<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_partenaire')->unsigned();
            $table->enum('type',['Coupé','Familiale','Cabriolet','Pickup','4x4','sport']);
            $table->string('marque');
            $table->string('modele');
            $table->string('cheminImages');
            $table->timestamps();
            $table->foreign('id_partenaire')->references('id')->on('partenaires')->onDelete('cascade')->onUpdate('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voitures');
    }
}
