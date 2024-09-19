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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_number')->unique();
            $table->foreignId('loan_product_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('term'); // Loan term in months
            $table->enum('payment_frequency', ['weekly', 'bi-weekly', 'monthly'])->default('monthly');
            $table->enum('status', ['pending', 'approved', 'disbursed'])->default('pending');
            $table->enum('state', ['active', 'inactive'])->default('inactive');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('approved_date')->nullable();
            $table->timestamp('disbursed_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
