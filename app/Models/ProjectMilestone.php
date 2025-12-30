<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectMilestone extends Model
{


use HasUuids, SoftDeletes, HasFactory;

protected $fillable = [
    'project_version_id',
    'title',
    'deliverables',
    'duration_days',
    'amount',
    'payment_status',
    'due_date',
    'developers_notes',
];

protected $casts = [
    'duration_days' => 'integer',
    'amount' => 'decimal:2',
    'due_date' => 'date',
];

public function project_version(): BelongsTo
{
    return $this->belongsTo(ProjectVersion::class);
}
}
