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
        Schema::create('owned_courses', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('member_id');
            $table->string('course_id');
            $table->string('transaction_detail_id');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id', 'member_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owned_courses');
    }
};
