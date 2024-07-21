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
            $table->uuid('id');
            $table->string('category_id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('author_id');
            $table->string('publisher');
            $table->string('isbn');
            $table->string('published_year');
            $table->string('cover');
            $table->decimal('price');
            $table->decimal('discount_price');
            $table->integer('total_pages');
            $table->integer('total_views');
            $table->integer('total_shares');
            $table->integer('total_purchased');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id', 'category_id']);
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
