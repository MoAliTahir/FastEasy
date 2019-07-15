<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentaireVoituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaire_voitures', function (Blueprint $table) {
            $table->increments('id');
            $table->text('avisPositive');
            $table->text('avisNegative');
            $table->integer('id_from')->unsigned();
            $table->integer('id_to')->unsigned();
            $table->string('history');
            $table->enum('note',[1,2,3,4,5]);
            $table->foreign('id_from')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_to')->references('id')->on('voitures')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('commentaires_voitures');
    }
}
