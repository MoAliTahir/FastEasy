<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_partenaire')->unsigned();
            $table->integer('id_voiture')->unsigned();
            $table->time('heureDebut');
            $table->time('heureFin');
            $table->string('ville');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->double('prix');
            $table->enum('statut',['disponible','reservé', 'traitement']);
            $table->integer('history')->default(0);
            $table->timestamps();
            $table->foreign('id_partenaire')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_voiture')->references('id')->on('voitures')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonces');
    }
}
