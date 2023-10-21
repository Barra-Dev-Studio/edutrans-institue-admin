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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('member_id');
            $table->string('ref_id');
            $table->integer('total_item');
            $table->decimal('total_price');
            $table->decimal('total_disc');
            $table->decimal('total_payment');
            $table->string('status');
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
        Schema::dropIfExists('transactions');
    }
};
