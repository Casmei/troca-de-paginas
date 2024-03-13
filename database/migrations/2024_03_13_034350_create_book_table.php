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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->string('title');
            $table->string('author');
            $table->longText('description');
            $table->enum('conservation_state', [
                'new',
                'excellent',
                'good',
                'regular',
                'worn',
                'damaged',
                'unusable',
            ]);
            $table->enum('genre', [
                'fiction',
                'romance',
                'suspense',
                'horror',
                'fantasy',
                'science_fiction',
                'drama',
                'action',
                'adventure',
                'mystery',
                'history',
                'biography',
                'self_help',
                'poetry',
                'short_story',
                'chronicle',
                'essay',
                'educational',
                'religion',
                'cooking',
                'comic_book',
                'manga',
                'children_literature',
            ]);
            $table->enum('transaction_type', [
                'donation',
                'borrow',
                'exchange',
            ]);
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
