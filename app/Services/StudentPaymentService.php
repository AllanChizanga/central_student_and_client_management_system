<?php

namespace App\Services;

use App\Repositories\StudentPaymentRepository;

class StudentPaymentService
{
    protected StudentPaymentRepository $student_payment_repository;
    public function __construct(StudentPaymentRepository $student_payment_repository)
    {
        $this->student_payment_repository = $student_payment_repository;
    }

  
    #create 
    public function create($student_payment_dto)
    {
        $payment = $this->student_payment_repository->create($student_payment_dto);
    }
    
}
