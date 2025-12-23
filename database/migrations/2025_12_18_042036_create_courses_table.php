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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->enum('category', ['Software Engineering', 'Cybersecurity', 'Artificial Intelligence']);
            $table->unsignedInteger('duration_months');
            $table->boolean('active')->default(true);
            $table->decimal('total_fee', 12, 2);
            $table->enum('fee_currency', ['USD', 'ZWL']);
            $table->decimal('monthly_fee', 12, 2);
            $table->string('syllabus_pdf')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
