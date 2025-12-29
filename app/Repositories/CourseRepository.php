<?php

namespace App\Repositories;

use Throwable;
use App\Models\Course;
use App\DTOs\CourseDTO;
use Illuminate\Database\Eloquent\Collection;

class CourseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // CREATE
    public function create(CourseDTO $course_dto)
    {
        try {
            $data = $course_dto->to_array();

            $course = Course::create($data);

            return $course;
        } catch (Throwable $e) {
            // Optionally, you can use a custom exception or handle/log here.
            logger()->error('Failed to create course: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return null;
        }
    }  // endof function

    // UPDATE
    public function update(CourseDTO $course_dto)
    {
        try {
            $data = $course_dto->to_array();

            $course = Course::find($data['id'] ?? null);

            if (!$course) {
                return null;
            }

            $course->fill($data);

            // Avoid updating the 'id' field if present in $data
            if (isset($data['id'])) {
                unset($data['id']);
            }

            $course->save();

            return $course;
        } catch (Throwable $e) {
            logger()->error('Failed to update course: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return null;
        }
    }


  
    public function fetch_all()
    {
        try 
        {
            return Course::query()->orderBy('created_at', 'desc')->get();

        } catch (Throwable $e) {
            logger()->error('Failed to fetch all courses: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return null;
        }
    } 


   
    public function fetch_one(string $course_id)
    {
        try
         {
            return Course::find($course_id);
         } 
         catch (Throwable $e) 
         {
            logger()->error('Failed to fetch one course: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return null;
        }
    }
}  // endof class
