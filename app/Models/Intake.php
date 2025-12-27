<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intake extends Model
{
    use SoftDeletes,HasUuids,HasFactory;
    protected $fillable = [
        'cohort',
        'start_date',
        'graduation_date',
    ];
}
