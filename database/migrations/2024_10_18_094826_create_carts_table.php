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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('guest_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('total_price', 8, 2)->nullable();
            $table->timestamps();

            // Foreign key relation to guests table using guest_identifier
            $table->foreign('guest_id')->references('guest_identifier')->on('guests')->onDelete('set null');

            // Foreign key relation to users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
