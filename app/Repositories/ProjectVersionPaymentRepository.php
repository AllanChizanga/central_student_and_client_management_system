<?php

namespace App\Repositories;

use Log;
use Throwable;
use App\Models\ProjectVersionPayment;

class ProjectVersionPaymentRepository
{
  
    public function create(object $payment_dto)
    {
        try {
            $data = $payment_dto->to_array();

            unset($data['id']);
            //  dd($data);
            return ProjectVersionPayment::create($data);

        } catch (Throwable $e) {
            Log::error('Failed to create ProjectVersionPayment', [
                'error' => $e->getMessage(),
                'dto' => (array) $payment_dto,
            ]);
            throw $e;
        }
    }
}
