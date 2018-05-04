<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTablePlace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->float('latitude', 10, 6);
            $table->float('longitude', 10, 6);
            $table->text('description');
            $table->string('adresse');
            $table->string('ville');
            $table->string('code_postal');
            $table->dateTime('horaire_debut');
            $table->dateTime('horaire_fin');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::table('places', function (Blueprint $table) {
            Schema::dropIfExists('places');
        });
    }
}
