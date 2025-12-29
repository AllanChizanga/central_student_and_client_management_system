<?php

namespace App\Repositories;

use App\DTOs\StudentDTO;
use App\Models\Student;
use Exception;
use Log;
use Throwable;

class StudentRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // CREATE
    public function create($student_dto)
    {
        try {
            $student_data = $student_dto->to_array();
            $student = Student::create($student_data);
            // dd($student);
            return $student;
        } catch (Throwable $e) {
            Log::error($e);
            $student = null;
            return $student;
        }
    }

    // UPDATE

    public function update(StudentDTO $student_dto)
    {
        try {
            $data = $student_dto->to_array();

            $student = Student::find($student_dto->id);

            if ($student) {
                $student->update($data);
            } else {
                throw new Throwable('Student not found.');
            }

            return $student;
        } catch (Throwable $e) {
            Log::error($e);
            return null;
        }
    }

    // FETCH

    public function fetch_all()
    {
        try {
            return Student::query()
                ->with('user')
                ->orderByDesc('created_at')
                ->get();
        } catch (Throwable $e) {
            Log::error($e);
            return null;
        }
    }
}  // endof clas
