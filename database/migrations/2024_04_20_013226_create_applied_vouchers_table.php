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
        Schema::create('applied_vouchers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('voucher_id');
            $table->uuid('transaction_id')->nullable();
            $table->decimal('disc_off_price');
            $table->decimal('disc_off_percent');
            $table->decimal('total_price');
            $table->decimal('total_disc');
            $table->string('status')->default('APPLIED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applied_vouchers');
    }
};
