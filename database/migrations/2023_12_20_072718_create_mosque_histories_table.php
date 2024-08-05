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
        Schema::create('mosque_histories', function (Blueprint $table) {
            $table->id();
            $table->string('title_ru', 100);
            $table->string('title_tt', 100);

            $table->string('text_ru');
            $table->string('text_tt');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mosque_histories');
    }
};
