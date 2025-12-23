<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;

class StudentLivewire extends Component
{
    use WithPagination;

    /**
     * Render the student management view with students paginated.
     */ 

     public function view_create_student_modal()
     {
        $this->dispatch('view-create-student-modal');
     }
    public function render(): View
    {
        $students = Student::with('user')->paginate(10);

        return view('livewire.student-livewire', [
            'students' => $students,
        ]);
    }
}
