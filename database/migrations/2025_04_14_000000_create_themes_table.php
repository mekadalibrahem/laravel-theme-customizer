<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('is_global')->default(false);
            $table->string('primary_color')->default('#3490dc');
            $table->string('secondary_color')->default('#ffed4a');
            $table->string('background_color')->default('#ffffff');
            $table->string('text_color')->default('#1a202c');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('themes');
    }
};