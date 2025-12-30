<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperatingExpense extends Model
{
    use HasUuids, SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'category',
        'amount',
        'billing_cycle',
        'vendor',
        'is_active',
        'next_due_date',
        'amount_type',
        'default_amount',
        'notes',
    ];

  
    protected function casts(): array
    {
        return [
            'amount'         => 'decimal:2',
            'is_active'      => 'boolean',
            'next_due_date'  => 'date',
        ];
    }
}
