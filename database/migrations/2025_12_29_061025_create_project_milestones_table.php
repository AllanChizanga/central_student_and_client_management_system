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
        Schema::create('project_milestones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('project_version_id');
            $table->string('title');
            $table->text('deliverables');
            $table->integer('duration_days')->default(0);
            $table->decimal('amount', 13, 2)->default(0.00);
            $table->enum('payment_status', ['pending', 'paid', 'overdue'])->default('pending');
            $table->date('due_date'); 
            $table->text('developers_notes');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_milestones');
    }
};
