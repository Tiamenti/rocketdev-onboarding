<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('city_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->string('place');
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->json('tags');
            $table->unsignedSmallInteger('capacity');
            $table->string('status');
            $table->unsignedTinyInteger('popularity');
            $table->unsignedInteger('change_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('city_events');
    }
};
