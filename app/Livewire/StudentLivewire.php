<?php

namespace App\Livewire;

use Log;
use Throwable;
use App\Models\Student;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Services\UserService;
use App\Services\StudentService;

class StudentLivewire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #attributes 

    public $search = ''; 

    public $students_tests; //using this var for tests only

    public $filter_enrollment = 'enrolled';
 
     protected StudentService $studentService;
     protected UserService $userService;

     public function boot(StudentService $studentService, UserService $userService): void
     {
         $this->studentService = $studentService;
         $this->userService = $userService;
     }
     public function view_create_student_modal()
     {
        $this->dispatch('view-create-student-modal');
     }
     

     #FETCH STUDENTS 
     public function fetch_all_students()
     { 

        try {
            $students = Student::with('user')
                ->when($this->search, function ($query) {
                    $query->where(function ($query) {
                        $query->whereHas('user', function ($q) {
                            $q->where('fullname', 'like', '%' . $this->search . '%')
                              ->orWhere('email', 'like', '%' . $this->search . '%')
                              ->orWhere('phonenumber', 'like', '%' . $this->search . '%');
                        })
                        ->orWhere('student_number', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->filter_enrollment, function ($query) {
                    $query->where('enrollment_status', $this->filter_enrollment);
                })
                ->orderByRaw("enrollment_status = 'enrolled' DESC")
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } catch (Throwable $e) {
            Log::error('Failed to fetch students: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $students = collect(); // Return empty collection in case of error
        } 
        $this->students_tests = $students->getCollection(); //just for the tests
        return $students; 

     }//endof fetch all students 


     #INITIATE UPDATE STUDENT 
     public function initiate_update_student($student_id)
     {
         $this->dispatch('initiate-update-student', [
             'student_id' => $student_id,
         ]);
     }


     #DELETE 
     public function delete($student_id)
     { 

        #delete student 
        #delete associated user because cascade was not used 
        #feedback
      $this->dispatch('not-authorized-to-delete-student');

     }


     #RENDER
    public function render(): View
    { 
     
         #fetch students
         $students = $this->fetch_all_students();

        return view('livewire.student-livewire', [
            'students' => $students,
        ]);
    }
}
