<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Quotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectVersion extends Model
{
    use HasUuids,SoftDeletes,HasFactory;

    protected $fillable = [
        'version_number',
        'client_id',
        'project_version_name',
        'project_progress_status',
        'start_date',
        'end_date',
        'brd_document',
        'contract',
        'nda',
        'quotation_id',
        'sprint_duration_days',
        'hosting_and_domain_fee',
        'has_whatsapp_integration',
        'has_ai_integration',
        'has_payments_integration',
        'has_other_third_party_integrations',
        'maintenance_type',
        'maintenance_fee_monthly',
        'billing_type',
        'amount',
        'paid',
        'balance',
        'currency',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'hosting_and_domain_fee' => 'decimal:2',
        'maintenance_fee_monthly' => 'decimal:2',
        'amount' => 'decimal:2',
        'paid' => 'decimal:2',
        'balance' => 'decimal:2',
        'has_whatsapp_integration' => 'boolean',
        'has_ai_integration' => 'boolean',
        'has_payments_integration' => 'boolean',
        'has_other_third_party_integrations' => 'boolean',
        'sprint_duration_days' => 'integer',
        'version_number' => 'integer',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

}
