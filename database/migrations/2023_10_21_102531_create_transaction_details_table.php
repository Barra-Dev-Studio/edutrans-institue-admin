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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('transaction_id');
            $table->string('item_id');
            $table->string('item_type');
            $table->decimal('price');
            $table->decimal('disc');
            $table->decimal('final_price');
            $table->timestamps();
            $table->softDeletes();
            $table->index('id', 'transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
