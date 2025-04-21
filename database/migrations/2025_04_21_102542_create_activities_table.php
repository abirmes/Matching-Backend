<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('date-debut');
            $table->dateTime('date-fin');
            $table->integer('max-participants');
            $table->integer('min-participants');
            $table->unsignedBigInteger('type-id');
            $table->foreign('type-id')->references('id')->on('types');
            $table->unsignedBigInteger('adresse-id');
            $table->foreign('adresse-id')->references('id')->on('adresses');
            $table->timestamps();
            $table->engine = 'InnoDB';

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
