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
        Schema::table('owned_courses', function (Blueprint $table) {
            $table->string('title');
            $table->string('mentor');
            $table->string('category');

            $table->index(['title', 'mentor', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('owned_courses', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('mentor');
            $table->dropColumn('category');
        });
    }
};
