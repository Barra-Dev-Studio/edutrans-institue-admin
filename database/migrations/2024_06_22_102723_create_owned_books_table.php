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
        Schema::create('owned_books', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('member_id');
            $table->string('book_id');
            $table->string('transaction_detail_id');
            $table->string('title');
            $table->string('category');
            $table->string('key');
            $table->string('author');
            $table->string('publisher');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owned_books');
    }
};
