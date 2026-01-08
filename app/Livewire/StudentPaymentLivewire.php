<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Enrollment;
use Livewire\Attributes\On;
use App\DTOs\StudentPaymentDTO;
use Livewire\Attributes\Validate;
use App\Services\EnrollmentService;
use App\Services\StudentPaymentService;

class StudentPaymentLivewire extends Component
{  

    #attributes  
    #[Validate('required|numeric|min:0.01')]
    public $amount_paid;

    #[Validate('required|string')]
    public $payment_method;

    #[Validate('nullable|date|after_or_equal:today')]
    public $next_due_date;
   
    public $enrollment;
  


    protected StudentPaymentService $student_payment_service;
    protected EnrollmentService $enrollment_service;

    public function boot(StudentPaymentService $student_payment_service,EnrollmentService $enrollment_service)
    {
        $this->student_payment_service = $student_payment_service;
        $this->enrollment_service = $enrollment_service;
    }

   
    public function to_array(): array
    {
        return [
            'id'              => null,
            'invoice_number'  => random_int(100000, 999999),
            'enrollment_id'   => $this->enrollment?->id,
            'previous_balance'=> (float) ($this->enrollment?->balance ?? '0.00'),
            'amount_paid'     => (float) $this->amount_paid,
            'current_balance' => (float) (
                $this->enrollment && is_numeric($this->enrollment->balance) && is_numeric($this->amount_paid)
                ? $this->enrollment->balance - $this->amount_paid
                : '0.00'
            ),
            'next_due_date'   => $this->next_due_date,
            'currency'        => $this->enrollment?->currency ?? 'USD',
            'payment_method'  => $this->payment_method,
        ];
    }

    public function record_payment(): void
    {  #validate
        $this->validate(); 
        #send array to payment dto 
        $student_payment_dto = StudentPaymentDTO::from_array($this->to_array());
        #create new payment  
        $payment = $this->student_payment_service->create($student_payment_dto);
        if(!$payment)
        {
            session()->flash('error','Failed to create payment');
        }
        #update enrollment 
        $response = $this->enrollment_service->update_balances($this->enrollment,$this->amount_paid);
        #feedback 
        if(!$response)
        {
            session()->flash('error','Failed to update this enrollment');
        }
        else{ 

            $this->dispatch('student-payment-recorded-successfully');
            
        }

       
    }

    #

    #[On('initiate-make-payment')]
    public function viewRecordStudentPaymentModal($enrollment_id)
    { 
        $this->enrollment = Enrollment::find($enrollment_id);
        $this->dispatch('view-record-student-payment-modal');
    }
    
    public function render()
    {
        return view('livewire.student-payment-livewire');
    }
}
