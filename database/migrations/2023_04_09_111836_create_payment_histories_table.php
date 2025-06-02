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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            // Corrected: Removed the second parameter '255' which is invalid for integer type.
            // Assuming course_id might be a foreign key, using unsignedBigInteger is often a good practice.
            // If it's just a regular integer, $table->integer('course_id')->nullable(); would also work.
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('payment_type', 255)->nullable();
            $table->float('amount', 10, 2)->nullable();
            $table->float('admin_revenue', 10, 2)->nullable();
            $table->float('instructor_revenue', 10, 2)->nullable();
            $table->float('tax', 10, 2)->nullable();
            $table->string('coupon', 255)->nullable();
            $table->string('invoice', 255)->nullable();
            // Corrected: Removed the second parameter '255' which is invalid for integer type.
            $table->integer('instructor_payment_status')->nullable();
            $table->string('transaction_id', 255)->nullable();
            $table->string('session_id', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};
