<?php

namespace App\Services;

use App\DTOs\CourseDTO;
use App\Repositories\CourseRepository;

class CourseService
{
  protected CourseRepository $course_repository;

  public function __construct(CourseRepository $course_repository)
  {
    $this->course_repository = $course_repository;
  }

  // CREATE
  public function create(CourseDTO $course_dto)
  {
    // send to repository
    $course = $this->course_repository->create($course_dto);

    return $course;
  }

  // Update
  public function update(CourseDTO $course_dto)
  {
    // send to repository
    $course = $this->course_repository->update($course_dto);

    return $course;
  }

  #fetch_all 
  public function fetch_all()
  {
    // send to repository
    $courses = $this->course_repository->fetch_all();

    return $courses;
  } 

  public function fetch_one_course($course_id)
  {
    $course = $this->course_repository->fetch_one($course_id);
    return $course;
  }
  
}  // endof class
