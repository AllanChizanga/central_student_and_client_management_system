<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{ 

    use HasUuids,SoftDeletes,HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'industry',
        'lifetime_revenue_contribution',
        'country',
        'city',
        'occupation',
        'address',
        'client_type',
        'client_status',
    ];

  
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
