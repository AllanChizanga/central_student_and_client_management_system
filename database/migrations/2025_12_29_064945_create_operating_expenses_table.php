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
        Schema::create('operating_expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->enum('category', ['utilities', 'staff', 'marketing', 'infrastructure']);
            $table->enum('billing_cycle', ['monthly', 'yearly']);
            $table->enum('amount_type', ['fixed', 'variable'])->default('fixed');
            $table->decimal('default_amount', 12, 2)->default(0.00); #if its variable
            $table->string('vendor');
            $table->boolean('is_active')->default(true);
            $table->date('next_due_date');
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operating_expenses');
    }
};
