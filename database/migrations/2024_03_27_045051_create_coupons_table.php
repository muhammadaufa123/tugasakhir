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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            // Corrected: Removed the second parameter '255' which is invalid for integer type.
            // Assuming user_id is a foreign key to the users table, using unsignedBigInteger is standard.
            // If it's just a regular integer and not a foreign key, $table->integer('user_id')->nullable(); is also fine.
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->string('code', 255)->nullable();
            $table->float('discount', 10, 2)->nullable();
            $table->string('expiry', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
