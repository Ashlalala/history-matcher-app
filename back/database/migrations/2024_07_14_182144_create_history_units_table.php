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
        Schema::create('history_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('history_id')->constrained('histories');
            $table->string('channel')->nullable();//remove nullable()
            $table->string('channel_url')->nullable();//remove nullable()
            $table->string('title');
            $table->string('title_url');
            $table->string('time')->nullable();//remove nullable()
            $table->timestamps();


            $table->index('history_id'); //find out if this is benefitioal in my situation (GPT says it is)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_units');
    }
};
