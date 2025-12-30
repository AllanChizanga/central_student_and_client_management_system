<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expense_instances', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Link to expense definition (rent, wifi, salaries, etc.)
            $table->foreignUuid('operating_expense_id');
               

            // The period this expense belongs to (e.g. 2026-01-01 for January)
            $table->date('period');

            // Financials
            $table->decimal('amount_due', 12, 2);
            $table->decimal('amount_paid', 12, 2)->default(0);

            // Payment state
            $table->enum('status', ['pending', 'paid', 'overdue'])->default('pending');

            // Dates
            $table->date('due_date')->nullable();
            $table->date('paid_at')->nullable();

            // Notes (manual or AI-generated later)
            $table->text('notes')->nullable();

            $table->softDeletes();

            $table->timestamps();

            // Prevent duplicate expense for same period
            $table->unique(['operating_expense_id', 'period']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_instances');
    }
};
