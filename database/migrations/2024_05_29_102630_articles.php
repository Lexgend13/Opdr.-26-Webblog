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
        Schema::create('Articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('text');
            $table->unsignedBigInteger('author_id')->constrained('users');
            $table->boolean('isPremium')->default(false);
            $table->string('image_path')->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};