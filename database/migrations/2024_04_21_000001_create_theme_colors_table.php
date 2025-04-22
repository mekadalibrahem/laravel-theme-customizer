<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

return new class extends Migration
{
    public function up()
    {
        $defaultColors = Config::get('theme-customizer.default_colors');

        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('key')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_global')->default(false);
            $table->timestamps();
        });

        Schema::create('theme_colors', function (Blueprint $table) use ($defaultColors) {
            $table->id();
            $table->foreignId('theme_id')->constrained()->onDelete('cascade');
            $table->string('primary')->default($defaultColors['primary']);
            $table->string('secondary')->default($defaultColors['secondary']);
            $table->string('accent')->default($defaultColors['accent']);
            $table->string('warning')->default($defaultColors['warning']);
            $table->string('success')->default($defaultColors['success']);
            $table->string('highlight')->default($defaultColors['highlight']);
            $table->string('dark')->default($defaultColors['dark']);
            $table->string('neutral')->default($defaultColors['neutral']);
            $table->string('light')->default($defaultColors['light']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('theme_colors');
        Schema::dropIfExists('themes');
    }
};
