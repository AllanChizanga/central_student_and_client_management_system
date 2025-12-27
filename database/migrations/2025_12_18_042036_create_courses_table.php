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
            $table->enum('category', [
                'Software Engineering', 
                'Cybersecurity',
                'Artificial Intelligence'
            ]);
            $table->boolean('active')->default(true);

            $table->unsignedInteger('duration_months');

            $table->enum('mode_of_learning', [
                'Evening Online',
                'Day In Person',
                'Evening In Person',
                'Weekend In Person',
                'Online Self Paced'
            ]);

            $table->decimal('total_fee', 12, 2);
            $table->enum('fee_currency', ['USD', 'ZWL']);
            $table->decimal('monthly_fee', 12, 2);

            $table->string('syllabus_pdf');
            $table->text('summary');
            $table->text('prerequisites');
            $table->text('weekly_schedule');
            $table->text('grading');
            $table->text('type_of_assessments');

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
