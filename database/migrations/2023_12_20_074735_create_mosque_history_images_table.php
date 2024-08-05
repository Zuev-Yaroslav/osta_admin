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
        Schema::create('mosque_history_images', function (Blueprint $table) {
            $table->id();
            $table->string('src', 512);

            $table->string('alt_ru', 100);
            $table->string('alt_tt', 100);

            $table->integer('sort_index');

            $table->foreignId('mosque_history_id')->index()->constrained('mosque_histories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mosque_history_images');
    }
};
