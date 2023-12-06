<?php

use App\Models\Party;
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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('moderator_uuid');
            $table->string('player_uuid');
            $table->text('players')->nullable();
            $table->unsignedBigInteger('party_stage_id')->nullable();
            $table->foreign('party_stage_id')->references('id')->on('party_stages')->noActionOnDelete();
            $table->integer('status')->default(Party::STATUS_ACTIVE);
            $table->integer('game_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
