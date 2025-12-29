<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminFee extends Model
{ 
   
    use HasUuids,SoftDeletes,HasFactory;
  
    protected $fillable = [
        'name',
        'description',
        'amount',
        'currency',
        'is_mandatory',
        'applies_to',
    ];

  
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'is_mandatory' => 'boolean',
        ];
    }

 
    public $timestamps = true;

    public function getKeyType(): string
    {
        return 'string';
    }

   
    public function getIncrementing(): bool
    {
        return false;
    }

  
    protected function dates(): array
    {
        return [
            'deleted_at',
            'created_at',
            'updated_at',
        ];
    }
}
