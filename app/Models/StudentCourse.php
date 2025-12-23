<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
class StudentCourse extends Model
{
    use HasUuids,SoftDeletes;

    protected $fillable = [
        'student_id',
        'course_id',
        'enrollment_date',
        'completion_status',
        'final_score',
        'registration_form_doc',
        'acceptance_letter_doc',
        'amount',
        'paid',
        'balance',
        'learning_mode',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var list<string>
     */
    protected $dates = [
        'enrollment_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the student that owns the StudentCourse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the course that owns the StudentCourse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

  
 
}
