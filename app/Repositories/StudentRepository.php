<?php

namespace App\Repositories;

use Log;
use Throwable;
use App\Models\Student;

class StudentRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    } 

    public function create($student_dto)
    {

    try {
        $student_data = $student_dto->to_array();
        $student = Student::create($student_data);
        //dd($student);
        return $student;
    }
     catch (Throwable $e) {
        Log::error($e);
        $student = null;
        return $student;
    }
    

 
    
    }
}
