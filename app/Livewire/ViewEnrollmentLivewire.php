<?php

namespace App\Livewire;

use App\Models\Enrollment;
use Livewire\Component;
use Livewire\WithPagination;

class ViewEnrollmentLivewire extends Component
{
    use WithPagination;

    public $search = '';

    // enrollments
    public function fetch_all_enrollments()
    {
        return Enrollment::with([
            'course',
            'intake',
            'student.user',
        ])
        ->when($this->search, function ($query) {
            $query->whereHas('student.user', function ($q) {
                $q->where('fullname', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('course', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('intake', function ($q) {
                $q->where('cohort', 'like', '%' . $this->search . '%');
            });
        })
        ->latest()
        ->paginate(20);
    } 



    #initiate_view_enrollment_modal 
    public function initiate_view_enrollment_modal()
    {
        $this->dispatch('initiate-view-enrollment-modal');
    } 


    #initiate_update_enrollment 
    public function initiate_update_enrollment($enrollment_id)
    { 

        $this->dispatch('initiate_update_enrollment',$enrollment_id);

    } 



    #delete_enrollment 
    public function delete_enrollment($enrollment_id)
    {
        $this->dispatch('not-authorized');
    }

    // render
    public function render()
    {
        $enrollments = $this->fetch_all_enrollments();
        return view('livewire.view-enrollment-livewire',compact('enrollments'));
    }
}
