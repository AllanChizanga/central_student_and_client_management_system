<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Concerns\HasUuids;
use \Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class Dropout extends Model
{
   use HasUuids,SoftDeletes,HasFactory;

    protected $fillable = [
        'enrollment_id',
        'reason',
        'dropped_on',
    ];

    protected function casts(): array
    {
        return [
            'dropped_on' => 'date',
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
            'dropped_on',
        ];
    }
}
