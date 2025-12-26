<?php

namespace App\Services;

use App\DTOs\StudentDTO;
use App\Repositories\StudentRepository;

class StudentService
{
    private $student_repository;
    public function __construct(StudentRepository $student_repository)
    { 

        $this->student_repository = $student_repository;
        
    } 


    #CREATE
    public function create(StudentDTO $student_dto)
    { 

        #pass to repository
       $student =  $this->student_repository->create($student_dto);
      //  dd($student);
       return $student;
        
    }


    #UPDATE 
    public function update(StudentDTO $student_dto)
    { 

        #pass to repository
       $student =  $this->student_repository->update($student_dto);
      //  dd($student);
       return $student;
        

}
}//endof class
