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
        Schema::create('histoire_tages', function (Blueprint $table) {
            $table->unsignedBigInteger('histoire_id')->unsigned()->nullable(false);
            $table->unsignedBigInteger('tag_id')->unsigned()->nullable(false);
            $table->foreign('histoire_id')->references('id')->on('histoires')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->primary(['histoire_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histoire_tages');
    }
};
