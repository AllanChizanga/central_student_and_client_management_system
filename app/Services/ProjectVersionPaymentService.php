<?php

namespace App\Services;
use App\Models\ProjectVersionPayment;
use App\DTOs\ProjectVersionPaymentDTO;
use App\Repositories\ProjectVersionPaymentRepository;

class ProjectVersionPaymentService
{ 

  
    protected ProjectVersionPaymentRepository $repository;
   
    public function __construct(ProjectVersionPaymentRepository $repository)
    { 
        $this->repository = $repository;
    
    }



   
    public function create(array $payment_data)
    {
        $previous_balance = $payment_data['project_version']->balance; 
        $amount = $payment_data['project_version']->amount; 
        $paid = $payment_data['project_version']->paid;  

        #calculate current_balance 
        $current_balance = $amount - ($paid + $payment_data['amount']); 
        #update payment data array 
        $payment_data['previous_balance'] = $previous_balance; 
        $payment_data['current_balance'] = $current_balance;  
        $payment_data['project_version_id'] = $payment_data['project_version']->id;
        $payment_data['amount_paid'] = $payment_data['amount'];
        $payment_data['invoice_number'] = random_int(100000, 999999);
        #to dto 

        $payment_dto = ProjectVersionPaymentDTO::from_array($payment_data); 

        #to repository 

        $payment = $this->repository->create($payment_dto);

        return $payment;



    }
}
