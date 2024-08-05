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
        Schema::create('building_images', function (Blueprint $table) {
            $table->id();
            $table->string('src', 512);

            $table->string('alt_ru', 100);
            $table->string('alt_tt', 100);

            $table->integer('sort_index');

            $table->foreignId('building_id')->index()->constrained('buildings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_images');
    }
};
