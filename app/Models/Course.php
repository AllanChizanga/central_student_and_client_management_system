<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasUuids,SoftDeletes;

    protected $fillable = [
        'name',
        'category',
        'active',
        'duration_months',
        'mode_of_learning',
        'total_fee',
        'fee_currency',
        'monthly_fee',
        'syllabus_pdf',
        'summary',
        'prerequisites',
        'weekly_schedule',
        'grading',
        'type_of_assessments',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var list<string>
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at' => 'datetime',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
