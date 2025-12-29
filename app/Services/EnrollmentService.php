<?php

namespace App\Services;

use App\DTOs\EnrollmentDTO;
use App\Repositories\EnrollmentRepository;

class EnrollmentService
{ 

    protected EnrollmentDTO $enrollment_dto;
    protected EnrollmentRepository $enrollment_repository;
    /**
     * Create a new class instance.
     */
    public function __construct(EnrollmentDTO $enrollment_dto,EnrollmentRepository $enrollment_repository)
    {
        $this->enrollment_dto = $enrollment_dto; 
        $this->enrollment_repository = $enrollment_repository;
    }

    #fetch_all 
    public function fetch_all()
    {
         $enrollments =  $this->enrollment_repository->fetch_all();
         return $enrollments;
    } 

  #fetch_all 
    public function fetch_one($enrollment_id)
    {
         $enrollment =  $this->enrollment_repository->fetch_one($enrollment_id);
         return $enrollment;
    }
    #create 
    public function create(EnrollmentDTO $enrollment_dto)
    {
        $enrollment = $this->enrollment_repository->create($enrollment_dto);
        return $enrollment;
    } 

  
    public function update(EnrollmentDTO $enrollment_dto)
    {
        $enrollment = $this->enrollment_repository->update($enrollment_dto);
        return $enrollment;
    }
}
