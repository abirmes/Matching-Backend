<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->id();
            $table->string('boulevard');
            $table->string('city');
            $table->string('country');
            $table->timestamps();
            $table->engine = 'InnoDB';

        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('adresses');
    }
};
