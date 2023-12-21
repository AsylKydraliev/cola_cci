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
        Schema::create('party_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('party_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('type');
            $table->text('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->foreign('answer_id')->references('id')->on('answers')->cascadeOnDelete();
            $table->integer('points')->default(0);
            $table->unsignedBigInteger('player_winner_id')->nullable();
            $table->foreign('player_winner_id')
                ->references('id')
                ->on('players')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_stages');
    }
};
