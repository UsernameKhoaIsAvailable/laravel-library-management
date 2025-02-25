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
        Schema::create('transaction_lines', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_completed')->default(false);
            $table->unsignedBigInteger('book_id'); // Foreign key for books
            $table->unsignedBigInteger('transaction_id'); // Foreign key for transactions
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_lines');
    }
};
