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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->decimal('price');
            $table->string('category_id');
            $table->text('note');
            $table->integer('total_views');
            $table->integer('total_shares');
            $table->integer('total_students');
            $table->integer('total_duration');
            $table->boolean('is_certified');
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
        Schema::dropIfExists('courses');
    }
};
