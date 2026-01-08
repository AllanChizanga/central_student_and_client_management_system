<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Concerns\HasUuids;
use \Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
   use HasUuids,SoftDeletes,HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'intake_id',
        'enrollment_date',
        'status',
        'amount',
        'paid',
        'balance',
        'currency',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function intake()
    {
        return $this->belongsTo(Intake::class);
    }
    public function student_payments()
    {
        return $this->hasMany(StudentPayment::class);
    }
}
