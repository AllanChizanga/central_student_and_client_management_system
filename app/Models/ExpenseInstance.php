<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpenseInstance extends Model
{
   
    use HasFactory,HasUuids,SoftDeletes;
    
    protected $fillable = [
        'operating_expense_id',
        'period',
        'amount_due',
        'amount_paid',
        'status',
        'due_date',
        'paid_at',
        'notes',
    ];
}
