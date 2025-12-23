<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{ 

    use HasUuids,SoftDeletes; 

    protected $fillable = [
        'user_id',
        'user_type',
        'amount',
        'currency',
        'payment_method',
        'payment_status',
        'payment_date',
        'reference_code',
    ]; 

    /**
     * Get the user that owns the payment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
