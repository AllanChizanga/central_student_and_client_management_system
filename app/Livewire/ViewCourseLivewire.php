<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class ViewCourseLivewire extends Component
{
    public $courses = [];

    public $search;

 
    #INITIATE  view-create-course-modal
    public function initiate_open_add_course_modal()
    {
        $this->dispatch('initiate_view-create-course-modal');
    } 


    #Stream  
    public function stream_syllabus(Course $course)
    {  

        

        return Storage::response($course->syllabus_pdf,$course->name);

    }


    #INITIATE UPDATE  COURSE
    public function initiate_update_course($course_id)
    { 
        
        $this->dispatch('initiate-view-update-course-modal',$course_id);
    }
 


    public function delete(Course $course)
    {
        $this->dispatch('not-authorized-to-delete');
    }

    # RENDER  
    public function render()
    {
        $query = Course::query();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%')
                  ->orWhere('mode_of_learning', 'like', '%' . $this->search . '%');
            });
        }

        $this->courses = $query->get();

        return view('livewire.view-course-livewire', [
            'courses' => $this->courses,
        ]);
    }
}
