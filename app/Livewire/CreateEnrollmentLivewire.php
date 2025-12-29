<?php

namespace App\Livewire;

use Livewire\Component;
use App\DTOs\EnrollmentDTO;
use Livewire\Attributes\On;
use App\Services\CourseService;
use App\Services\IntakeService;
use App\Services\StudentService;
use Livewire\Attributes\Validate;
use App\Services\EnrollmentService;

class CreateEnrollmentLivewire extends Component
{ 
    #properties to feed the select boxes 
    public $students = [];
    public $courses = [];
    public $intakes = []; 

    #properties from the enrollment table 
    #[Validate('required')]
    public $student_id;

    #[Validate('required')]
    public $course_id;

    #[Validate('required')]
    public $intake_id;

    #[Validate('required|date')]
    public $enrollment_date;

    #[Validate('required|string')]
    public $status;

    // #[Validate('nullable|numeric')]
    // public $amount;

    // #[Validate('nullable|numeric')]
    // public $paid;

    // #[Validate('nullable|numeric')]
    // public $balance;

    // #[Validate('nullable|string')]
    // public $currency;


    #boot 
    protected StudentService $student_service;
    protected CourseService $course_service;
    protected IntakeService $intake_service;
    protected EnrollmentService $enrollment_service;
   public function boot(StudentService $student_service,CourseService $course_service,IntakeService $intake_service,EnrollmentService $enrollment_service)
   { 
    

       $this->student_service = $student_service;
       $this->course_service = $course_service;
       $this->intake_service = $intake_service;
       $this->enrollment_service = $enrollment_service;


   } #endof boot()
 

   #fetch students
   public function fetch_all_students()
   { 
    $this->students =  $this->student_service->fetch_all();

   } 

   #fetch courses 
   public function fetch_all_courses()
   { 
    $this->courses =  $this->course_service->fetch_all();

   } 

   #fetch intakes 
   public function fetch_all_intakes()
   { 
    $this->intakes =  $this->intake_service->fetch_all();

   } 

   #fetch one course 
   public function fetch_one_course()
   { 

    $course = $this->course_service->fetch_one_course($this->course_id);
    return $course;

   }

    public function to_array(): array
    {
        return [
            'student_id'       => $this->student_id ?? 'xx',
            'course_id'        => $this->course_id ?? '',
            'intake_id'        => $this->intake_id ?? '',
            'enrollment_date'  => $this->enrollment_date ?? now()->toDateString(),
            'status'           => $this->status ?? 'enrolled',
            'amount'           => $this->fetch_one_course()->total_fee ?? 0.00,
            'paid'             => 0.00,
            'balance'          => 0.00,
            'currency'         => 'USD',
        ];
    } 


    #create_enrollment
    public function create_enrollment()
    { 
        #validate 
        $this->validate();
        #collect array 
        $enrollment_array = $this->to_array();
        #pass array to dto 
        $enrollment_dto = EnrollmentDTO::from_array($enrollment_array);
        #pass dto to service 
        $enrollment = $this->enrollment_service->create($enrollment_dto);
        #feedback
        if(!$enrollment)
        {
            session()->flash('error','Failed To Create Enrollment'); 

        }
        else{
            $this->dispatch('enrollment-created-successfully');
        }

    }

    #events  
    #[On('initiate-view-enrollment-modal')]
    public function handle_initiate_view_enrollment_modal_event(): void
    { 
        $this->fetch_all_students();
        $this->fetch_all_courses();
        $this->fetch_all_intakes();
        $this->dispatch('view-create-enrollment-modal');
    }

    #render
    public function render()
    {
        return view('livewire.create-enrollment-livewire');
    }
}
