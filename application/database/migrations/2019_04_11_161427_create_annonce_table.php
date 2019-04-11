<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnonceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonce', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_partenaire')->unsigned();
            $table->integer('id_voiture')->unsigned();
            $table->foreign('id_partenaire')->references('id')->on('partenaire')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_voiture')->references('id')->on('voiture')->onDelete('cascade')->onUpdate('cascade');
            $table->time('heureDebut');
            $table->time('heureFin');
            $table->date('date_annonce');
            $table->double('prix');
            $table->enum('statut',['disponible','reservé']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonce');
    }
}
