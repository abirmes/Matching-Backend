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
        Schema::create('participer', function (Blueprint $table) {
            $table->id();
            $table->integer('participater-number')->unique();
            $table->unsignedBigInteger('user-id');
            $table->foreign('user-id')->references('id')->on('users');
            $table->unsignedBigInteger('team-id');
            $table->foreign('team-id')->references('id')->on('teams');
            $table->unsignedBigInteger('acivity-id');
            $table->foreign('acivity-id')->references('id')->on('acivities');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('participer');
    }
};
