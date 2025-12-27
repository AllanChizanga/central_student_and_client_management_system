<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Intake extends Model
{
    use SoftDeletes,HasUuids;
    protected $fillable = [
        'cohort',
        'start_date',
        'graduation_date',
    ];
}
