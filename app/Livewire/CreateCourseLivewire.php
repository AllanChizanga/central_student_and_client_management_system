<?php

namespace App\Livewire;

use App\DTOs\CourseDTO;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Services\CourseService;
use Livewire\Attributes\Validate;
use App\Actions\SavePrivateDocumentAction;

class CreateCourseLivewire extends Component
{  
   use WithFileUploads;
    // Course attributes with validation using Validate attribute

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|in:Software Engineering,Cybersecurity,Artificial Intelligence')]
    public string $category = '';

    #[Validate('required|boolean')]
    public bool $active = true;

    #[Validate('required|integer|min:1')]
    public int $duration_months;

    #[Validate('required|in:Evening Online,Day In Person,Evening In Person,Weekend In Person,Online Self Paced')]
    public string $mode_of_learning = '';

    #[Validate('required|numeric|min:0')]
    public float $total_fee;

    #[Validate('required|in:USD,ZWL')]
    public string $fee_currency = 'USD';

    #[Validate('required|numeric|min:0')]
    public float $monthly_fee;

    #[Validate('required|file|mimes:pdf|max:10240')]
    public $syllabus_pdf = null;

    #[Validate('required|string|max:1000')]
    public string $summary;

    #[Validate('required|string|max:1000')]
    public string $prerequisites;

    #[Validate('required|string|max:1000')]
    public string $weekly_schedule;

    #[Validate('required|string|max:1000')]
    public string $grading;

    #[Validate('required|string|max:1000')]
    public string $type_of_assessments; 
   
    

    #BOOT 
    protected CourseService $course_service;
    protected SavePrivateDocumentAction $save_private_document;
    public function boot(CourseService $course_service,SavePrivateDocumentAction $save_private_document): void
    {
        $this->course_service = $course_service;
        $this->save_private_document = $save_private_document;
    }
    
    #handle view-create-course-modal 
    #[On('initiate_view-create-course-modal')]
    public function handle_view_create_course_modal_event(): void
    {
        $this->dispatch('view-create-course-modal');
    } 



    #COURSEDATA 
    public function get_course_array_data(): array
    {
        return [
            'name' => $this->name,
            'category' => $this->category,
            'active' => $this->active,
            'duration_months' => $this->duration_months,
            'mode_of_learning' => $this->mode_of_learning,
            'total_fee' => $this->total_fee,
            'fee_currency' => $this->fee_currency,
            'monthly_fee' => $this->monthly_fee,
            'syllabus_pdf' => $this->syllabus_pdf,
            'summary' => $this->summary,
            'prerequisites' => $this->prerequisites,
            'weekly_schedule' => $this->weekly_schedule,
            'grading' => $this->grading,
            'type_of_assessments' => $this->type_of_assessments,
        ];
    }


    #CREATE COURSE 
    public function create_course()
    {
        #validate  
        $this->validate();
       #course data 
       $course_data = $this->get_course_array_data(); 
       #save syllabus using action and return the document name 
       $syllabus_pdf_path = $this->save_private_document->execute('syllabuses',$course_data['syllabus_pdf']); #directory and file as parameters
       if(!$syllabus_pdf_path)
       {
        session()->flash('error','Failed To Save Syllabus');
       }
       #update syllabus name 
       $course_data['syllabus_pdf'] = $syllabus_pdf_path;
        #dto 
        $course_dto = CourseDTO::from_array($course_data);
        #service
        $course = $this->course_service->create($course_dto);
        #feedback 
        if(!$course)
        { 
            session()->flash('error','Failed To Create Course');
        }
        else{
             
            $this->dispatch('course-created-successfully');
        }
    }//endof function

    #RENDER
    public function render()
    {
        return view('livewire.create-course-livewire');
    }
}
