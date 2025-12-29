<?php

namespace App\Repositories;

use Log;
use Throwable;
use App\Models\Enrollment;
use App\DTOs\EnrollmentDTO;
use Illuminate\Database\Eloquent\Collection;

class EnrollmentRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // fetchall
    public function fetch_all(): Collection
    {
        try {
            $enrollments = Enrollment::with([
                'course',
                'intake',
                'student.user',
            ])->get();

            return $enrollments->isEmpty() ? new collection() : $enrollments;
        } catch (Throwable $e) {
            Log::error('Failed to fetch enrollments: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return new Collection();
        }
    }  // endof function

   

    #fetch_one 

    public function fetch_one($enrollment_id): ?Enrollment
    {
        try 
        {
            return Enrollment::with([
                'course',
                'intake',
                'student.user',
            ])->find($enrollment_id);

        } 
        catch (Throwable $e) 
        {
            Log::error('Failed to fetch enrollment: ' . $e->getMessage(), [
                'exception' => $e,
                'enrollment_id' => $enrollment_id,
            ]);
            return null;
        }
    }

    #create 
   
    public function create(EnrollmentDTO $enrollment_dto): ?Enrollment
    {
        try 
        {
            $enrollment = Enrollment::create($enrollment_dto->to_array());

            return $enrollment;

        } catch (Throwable $e) 
        {
            Log::error('Failed to create enrollment: ' . $e->getMessage(), [
                'exception' => $e,
                'student_id' => $enrollment_dto->student_id,
                'course_id' => $enrollment_dto->course_id,
            ]);
            return null;
        }
    }

    #update 
    public function update(EnrollmentDTO $enrollment_dto): ?Enrollment
    {
        try {
            $enrollment = Enrollment::find($enrollment_dto->id);

            if (!$enrollment) {
                Log::warning('Enrollment not found for update.', [
                    'enrollment_id' => $enrollment_dto->id,
                ]);
                return null;
            }

            $enrollment->fill($enrollment_dto->to_array());
            $enrollment->save();

          
            $enrollment->load([
                'course',
                'intake',
                'student.user',
            ]);

            return $enrollment;
        } catch (Throwable $e) {
            Log::error('Failed to update enrollment: ' . $e->getMessage(), [
                'exception' => $e,
                'enrollment_id' => $enrollment_dto->id ?? null,
            ]);
            return null;
        }
    }
}  // endof class
