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
        Schema::create('project_versions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('version_number');
            $table->uuid('client_id');
            $table->string('project_version_name');
            $table->enum('project_progress_status', [
                'backlog_development',         // Product Backlog Development – planning and requirements gathering
                'backlog_review',              // Product Backlog Review Meeting – stakeholder approval/refinement
                'sprint_development',          // Sprint Development – active development of features
                'mvp_release',                 // MVP Release – first usable version of the product
                'production',                  // System in Production – product is live and actively used by clients
                'maintenance_mode',                 // Maintenance Mode – post-release support, bug fixes, updates
            ]);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('brd_document');
            $table->string('contract');
            $table->string('nda');
            $table->uuid('quotation_id')->nullable(); #quotation is added after the milestones are created
            $table->integer('sprint_duration_days')->default(0); // Duration in days for each sprint
            
            $table->decimal('hosting_and_domain_fee', 13, 2)->default(0.00);
            $table->boolean('has_whatsapp_integration')->default(false);
            $table->boolean('has_ai_integration')->default(false);
            $table->boolean('has_payments_integration')->default(false);
            $table->boolean('has_other_third_party_integrations')->default(false);
            $table->enum('maintenance_type', ['monthly', 'on_call']);
            $table->decimal('maintenance_fee_monthly', 13, 2)->default(0.00);
            $table->enum('billing_type', ['milestone', 'fortnightly']);
            $table->decimal('amount', 13, 2)->default(0.00);
            $table->decimal('paid', 13, 2)->default(0.00);
            $table->decimal('balance', 13, 2)->default(0.00);
            $table->string('currency', 10)->default('USD');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_versions');
    }
};
