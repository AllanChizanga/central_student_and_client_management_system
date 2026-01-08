<?php

namespace App\Repositories;

use Log;
use Throwable;
use App\Models\StudentPayment;

class StudentPaymentRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    } 

    public function create($student_payment_dto)
    {
        $data = $student_payment_dto->to_array();
        unset($data['id']);

        try {
          
            return StudentPayment::create($data);
            
        } catch (Throwable $e) {
            Log::error('Failed to create StudentPayment', [
                'data' => $data,
                'dto_class' => get_class($student_payment_dto),
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
