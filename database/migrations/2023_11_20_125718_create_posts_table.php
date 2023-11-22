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
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title');
            $table->string('slug');
            $table->string('thumbnail');
            $table->text('content');
            $table->string('tags');
            $table->text('description');
            $table->string('author');
            $table->integer('views')->default(0);
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
