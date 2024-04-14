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
        Schema::create('histoires', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('intro');
            $table->string('image');
            $table->string('audio');
            $table->integer('nb_vue')->nullable();
            $table->float('note')->nullable();
            $table->integer('nb_notes')->nullable();
            $table->foreignId('caverne_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histoires');
    }
};
