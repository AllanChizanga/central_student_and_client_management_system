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
        Schema::create('payroll_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('employee_id');
            $table->enum('salary_type', ['fixed', 'hourly']);
            $table->decimal('base_salary', 12, 2)->nullable();
            $table->decimal('hourly_rate', 12, 2)->nullable();
            $table->enum('payment_cycle', ['monthly', 'biweekly']);
            $table->decimal('tax_rate', 5, 2)->nullable();
            $table->json('allowances')->nullable();
            $table->json('deductions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_profiles');
    }
};
