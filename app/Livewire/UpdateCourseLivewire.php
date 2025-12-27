<?php

namespace App\Livewire;

use App\Models\Course;
use App\DTOs\CourseDTO;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Services\CourseService;
use Livewire\Attributes\Validate;
use App\Actions\SavePrivateDocumentAction;

class UpdateCourseLivewire extends Component
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

    #[Validate('nullable')]
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

    #other attributes 
    public Course $course;

    // BOOT
    protected CourseService $course_service;
    protected SavePrivateDocumentAction $save_private_document;

    public function boot(CourseService $course_service, SavePrivateDocumentAction $save_private_document): void
    {
        $this->course_service = $course_service;
        $this->save_private_document = $save_private_document;
    }
 


    public function fetch_course($course_id)
    {
        $course = Course::findOrFail($course_id);
        $this->course = $course;


        $this->name = $course->name;
        $this->category = $course->category;
        $this->active = $course->active;
        $this->duration_months = $course->duration_months;
        $this->mode_of_learning = $course->mode_of_learning;
        $this->total_fee = $course->total_fee;
        $this->fee_currency = $course->fee_currency;
        $this->monthly_fee = $course->monthly_fee;
        #fetch private document 
        $this->syllabus_pdf = $course->syllabus_pdf;
        $this->summary = $course->summary;
        $this->prerequisites = $course->prerequisites;
        $this->weekly_schedule = $course->weekly_schedule;
        $this->grading = $course->grading;
        $this->type_of_assessments = $course->type_of_assessments;

      
    }



    // EVENT-HANDLER
    #[On('initiate-view-update-course-modal')]
    public function handle_initiate_update_course_modal($course_id)
    {
        $this->fetch_course($course_id);
        $this->dispatch('view-update-course-modal');
    }

    public function get_course_array_data(): array
    {
        return [
            'id'=>$this->course->id,
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

    // UPDATE
    public function update_course()
    {
        // validate
        $this->validate();
        // course data
        $course_data = $this->get_course_array_data();
        // save syllabus using action and return the document name
        if (is_object($course_data['syllabus_pdf']))
         {
            $syllabus_pdf_path = $this->save_private_document->execute($course_data['syllabus_pdf']);

            if (!$syllabus_pdf_path) {
                session()->flash('error', 'Failed To Save Syllabus');
                exit;
            }
        } //endof if
        
       
        // update syllabus name
        $course_data['syllabus_pdf'] = isset($syllabus_pdf_path) ? $syllabus_pdf_path : $this->course->syllabus_pdf;
        // dto
        $course_dto = CourseDTO::from_array($course_data);
        // service
        $course = $this->course_service->update($course_dto);
        // feedback
        if (!$course) {
            session()->flash('error', 'Failed To update Course');
        } else {
            $this->dispatch('course-updated-successfully');
        }
    }  // endof function

    // RENDER
    public function render()
    {
        return view('livewire.update-course-livewire');
    }
}
