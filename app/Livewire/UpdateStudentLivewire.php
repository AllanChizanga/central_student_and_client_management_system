<?php

namespace App\Livewire;

use App\DTOs\UserDTO;
use App\Models\Student;
use Livewire\Component;
use App\DTOs\StudentDTO;
use Livewire\Attributes\On;
use App\Services\UserService;
use App\Services\StudentService;
use Livewire\Attributes\Validate;

class UpdateStudentLivewire extends Component
{ 

    #[Validate('required|string|exists:students,id')]
    public $student_id;

    #[Validate('required|string|max:255')]
    public $fullname;

    #[Validate('required|email|max:255|exists:users,email')]
    public $email;

    #[Validate('required|string|min:6')]
    public $password = "zomac_student";

    #[Validate('required|string|size:12|regex:/^263[0-9]{9}$/|exists:users,phonenumber')] #12 characters starting with 263

    public $phonenumber;

    // #[Validate('required|string|max:50')]
    // public $student_number;

    #[Validate('required|string|in:student,client,lead')]
    public $user_type;

    #[Validate('required|string|in:active,inactive,suspended')]
    public $status;

    #[Validate('required|string|in:enrolled,pending')]
    public $enrollment_status;

    #[Validate('required|string|in:male,female,other')]
    public $gender;

    #[Validate('required|string|max:255')]
    public $address;

    #[Validate('required|string|max:100')]
    public $city;

    // #[Validate('nullable|integer|exists:users,id')]
    // public $user_id;  
    #[Validate('required|date')]
    public $admission_date = null;

    #[Validate('required|date')]
    public $graduation_date;
    #[Validate('nullable|string|exists:users,id')]
    public $user_id;
    #[Validate('required|string|max:50')]
    public $student_number;

    #BOOT 
    protected UserService $user_service;
    protected StudentService $student_service;

    public function boot(UserService $user_service,StudentService $student_service)
    { 

        $this->user_service = $user_service;
        $this->student_service = $student_service;

    }

    #INITIATE UPDATE STUDENT
    #[On('initiate-update-student')]
    public function view_update_student_modal(array $payload): void
    { 
        $student = Student::with('user')->findOrFail($payload['student_id']);
        $user = $student->user;

        $this->fullname = $user?->fullname;
        $this->user_id = $user?->id ?? null;
        $this->email = $user?->email;
        $this->phonenumber = $user?->phonenumber;
        $this->user_type = $user?->user_type;
        $this->status = $user?->status;
        $this->enrollment_status = $student->enrollment_status;
        $this->gender = $student->gender;
        $this->address = $student->address;
        $this->city = $student->city;
        $this->admission_date = $student->admission_date;
        $this->graduation_date = $student->graduation_date;
        $this->student_id = $student->id;
        $this->student_number = $student->student_number;
        
        $this->dispatch('view-update-student-modal');
    } 

    #USER DATA 
    public function user_data()
    {
       return [
        'id' => $this->user_id,
        'fullname'=>$this->fullname,
        'email'=>$this->email,
        'password'=>$this->password, 
        'phonenumber'=>$this->phonenumber,
        'user_type'=>$this->user_type,
        'status'=>$this->status,
       ];
    } 

    #STUDENT DATA 
    public function student_data(): array
    {
        return [
            'id' => $this->student_id,
            'user_id' => $this->user_id,
            'student_number' => $this->student_number,
            'enrollment_status' => $this->enrollment_status,
            'gender' => $this->gender,
            'address' => $this->address,
            'city' => $this->city,
            'admission_date' => $this->admission_date,
            'graduation_date' => $this->graduation_date,
        ];
    }


    #UPDATE USER 
    public function update_user()
    {
        #collect data
        $user_data = $this->user_data();
        #pass data to userDTO 
        $userDTO = UserDTO::from_array($user_data);
        #pass data to service 
        $user =   $this->user_service->update($userDTO);
        return $user;
    }



    #UPDATE STUDENT
    public function update_student($user)
    {
           #create student 
           $student_data  = $this->student_data();
           $student_data['user_id'] = $user->id; 
           #student dto 
           $student_dto = StudentDTO::from_array($student_data);
           #service 
           $student =  $this->student_service->update($student_dto);
   
           return $student;
    }

    #UPDATE FUNCTION 
    public function update()
    { 
        #validate 
        $this->validate();
        #update user 
        $user = $this->update_user();
        #update student 
        $student = $this->update_student($user);
        #feedback 
        // dd($student);
        if($user && $student)
        {
            $this->dispatch('student-updated-successfully');
        }
        else{
            session()->flash('error', 'Failed to update student.');
           $this->dispatch('student-updated-failed');
            
        }
    }//endof function


    #RENDER 
    public function render()
    {
        return view('livewire.update-student-livewire');
    }
}
