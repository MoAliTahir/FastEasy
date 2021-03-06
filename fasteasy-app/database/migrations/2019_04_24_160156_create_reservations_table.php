<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_client')->unsigned();
            $table->integer('statut')->default(0);
            $table->integer('id_annonce')->unsigned();
            $table->Integer('confirmer')->default(0);
            $table->foreign('id_client')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_annonce')->references('id')->on('annonces')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('reservations');
    }
}
