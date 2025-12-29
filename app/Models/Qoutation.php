<?php

namespace App\Models;

use App\Models\ProjectVersion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Qoutation extends Model
{


use HasUuids, SoftDeletes, HasFactory;

protected $fillable = [
    'client_id',
    'project_version_id',
    'qoute_id',
    'description',
    'total_amount',
    'status',
    'valid_until',
];

public function project_version(): BelongsTo
{
    return $this->belongsTo(ProjectVersion::class);
}

public function client(): BelongsTo
{
    return $this->belongsTo(Client::class);
}

}
