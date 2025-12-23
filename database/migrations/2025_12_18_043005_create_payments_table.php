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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->enum('user_type', ['student', 'client']);
            $table->decimal('amount', 12, 2);
            $table->enum('currency', ['USD', 'ZWL']);
            $table->enum('payment_method', ['Ecocash', 'Bank', 'Cash', 'Innbucks', 'Omari', 'Visa', 'Other']);
            $table->string('payment_status');
            $table->date('payment_date');
            $table->string('reference_code')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
