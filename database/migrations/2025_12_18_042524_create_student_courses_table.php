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
        Schema::create('student_courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignUuid('course_id')->constrained('courses')->onDelete('cascade');
            $table->date('enrollment_date');
            $table->enum('completion_status', ['enrolled', 'completed', 'dropped'])->default('enrolled');
            $table->decimal('final_score', 5, 2)->nullable();
            $table->string('registration_form_doc')->nullable();
            $table->string('acceptance_letter_doc')->nullable();
            $table->decimal('amount', 12, 2);
            $table->boolean('paid')->default(false);
            $table->decimal('balance', 12, 2)->default(0);
            $table->enum('learning_mode', ['Online', 'Day', 'Evening', 'Weekend']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_courses');
    }
};
