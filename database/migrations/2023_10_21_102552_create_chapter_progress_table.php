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
        Schema::create('chapter_progress', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('owned_course_id');
            $table->string('last_chapter_id');
            $table->integer('total_duration');
            $table->json('chapters_completed');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id', 'owned_course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapter_progress');
    }
};
