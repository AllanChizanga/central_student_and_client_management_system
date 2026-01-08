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
        Schema::create('project_version_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('invoice_number');
            $table->foreignUuid('project_version_id');
            $table->decimal('previous_balance',15,2);
            $table->decimal('amount_paid',15,2); 
            $table->decimal('current_balance',15,2);
            $table->date('next_due_date'); 
            $table->string('currency')->default('USD');
            $table->enum('payment_method', ['Ecocash', 'Bank', 'Cash', 'Innbucks', 'Omari', 'Visa', 'Other']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_version_payments');
    }
};
