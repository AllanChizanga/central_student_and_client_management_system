<?php

namespace App\Livewire;

use Livewire\Component;
use App\DTOs\EnrollmentDTO;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use App\Services\EnrollmentService;

class UpdateEnrollmentLivewire extends Component
{  

    #attributes to populate select tags 

    public $students = [];
    public $courses = [];
    public $intakes = []; 

    #attributes from enrollment model 
    #[Validate('required')]
    public $student_id;

    #[Validate('required')]
    public $course_id;

    #[Validate('required')]
    public $intake_id;

    #[Validate('required')]
    public $enrollment_date;

    #[Validate('required')]
    public $status;

    #[Validate('required')]
    public $amount;

    #[Validate('required')]
    public $paid;

    #[Validate('required')]
    public $balance;

    #[Validate('required')]
    public $currency; 

    #the model to be updated 
    public $enrollment; 

    #boot 
    protected EnrollmentService $enrollment_service;
    public function boot(EnrollmentService $enrollment_service)
    { 
        $this->enrollment_service = $enrollment_service;

    }



    #initiate_update_enrollment 
    #[On('initiate_update_enrollment')]
    public function handleInitiateUpdateEnrollment($enrollment_id)
    { 
        #fetch this one model 
        $this->enrollment = $this->enrollment_service->fetch_one($enrollment_id);
        #initiate public attributes
        $this->student_id = $this->enrollment->student_id;
        $this->course_id = $this->enrollment->course_id;
        $this->intake_id = $this->enrollment->intake_id;
        $this->enrollment_date = $this->enrollment->enrollment_date;
        $this->status = $this->enrollment->status;
        $this->amount = $this->enrollment->amount;
        $this->paid = $this->enrollment->paid;
        $this->balance = $this->enrollment->balance;
        $this->currency = $this->enrollment->currency;

        $this->dispatch('view-update-enrollment-modal', enrollment_id: $enrollment_id);
    } 


    /**
     * Convert the current Livewire component state to an array for update operations,
     * initializing with the existing enrollment model values if fields are not set.
     */
    public function to_array(): array
    {
        return [
            'id'               => $this->enrollment?->id,
            'student_id'       => $this->student_id ?? $this->enrollment?->student_id,
            'course_id'        => $this->course_id ?? $this->enrollment?->course_id,
            'intake_id'        => $this->intake_id ?? $this->enrollment?->intake_id,
            'enrollment_date'  => $this->enrollment_date ?? $this->enrollment?->enrollment_date,
            'status'           => $this->status ?? $this->enrollment?->status,
            'amount'           => $this->amount ?? $this->enrollment?->amount,
            'paid'             => $this->paid ?? $this->enrollment?->paid,
            'balance'          => $this->balance ?? $this->enrollment?->balance,
            'currency'         => $this->currency ?? $this->enrollment?->currency,
        ];
    }
    #update_enrollment 
    public function update_enrollment()
    {
            $this->dispatch('not-authorized');
            return;
        
        $enrolment_dto = EnrollmentDTO::from_array($this->to_array());
        #service 
        $enrollment = $this->enrollment_service->update($enrolment_dto);
        #feedback
        if(!$enrollment)
        {
        session()->flash('error', 'Failed to update enrollment. Please try again or contact support.');
        }
        else
        {
            $this->dispatch('enrollment-updated-successfully');
        }
    }
    public function render()
    {
        return view('livewire.update-enrollment-livewire');
    }
}
