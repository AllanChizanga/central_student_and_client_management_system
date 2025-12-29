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
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('company_name');
            $table->string('industry');
            $table->decimal('lifetime_revenue_contribution', 15, 2)->default(0);
            $table->string('country');
            $table->string('city');
            $table->string('occupation')->nullable();
            $table->string('address')->nullable();
            $table->enum('client_type', ['individual', 'organization'])->default('individual');
            $table->enum('client_status', ['lead', 'active', 'completed'])->default('active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
