<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('genero_id');
            $table->foreign('genero_id')->references('id')->on('genero')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('pais_id');
            $table->foreign('pais_id')->references('id')->on('pais')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('idioma_id');
            $table->foreign('idioma_id')->references('id')->on('idioma')->onUpdate('cascade')->onDelete('cascade');
            $table->string('username')->unique();
            $table->string('foto')->nullable();
            $table->date('cumple');
            $table->text('descripcion')->nullable();
            $table->string('slug')->unique();
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
        Schema::dropIfExists('perfil');
    }
};
