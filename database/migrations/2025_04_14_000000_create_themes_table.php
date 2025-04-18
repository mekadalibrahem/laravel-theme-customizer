<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_global')->default(false);
            $table->string('key');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->string('primary_color');
            $table->string('secondary_color');
            $table->string('light_primary');
            $table->string('light_secondary');
            $table->string('accent_color');
            $table->string('text_light');
            $table->string('text_dark');
            $table->string('dark_background');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_id', 'key']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('themes');
    }
}