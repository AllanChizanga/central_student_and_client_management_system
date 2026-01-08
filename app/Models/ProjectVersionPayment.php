<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectVersionPayment extends Model
{
  
    use HasFactory,HasUuids,SoftDeletes; 
    protected $fillable = [
        'invoice_number',
        'project_version_id',
        'previous_balance',
        'amount_paid',
        'current_balance',
        'next_due_date',
        'currency',
        'payment_method',
    ]; 
}
