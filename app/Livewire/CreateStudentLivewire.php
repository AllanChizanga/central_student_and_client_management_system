<?php

namespace App\Livewire;

use App\DTOs\UserDTO;
use Livewire\Component;
use App\DTOs\StudentDTO;
use App\Services\UserService;
use App\Services\StudentService;
use Livewire\Attributes\Validate;

class CreateStudentLivewire extends Component
{
    #[Validate('required|string|max:255')]
    public $fullname;

    #[Validate('required|email|max:255|unique:users,email')]
    public $email;

    #[Validate('required|string|min:6')]
    public $password = "zomac_student";

    #[Validate('required|string|size:12|regex:/^263[0-9]{9}$/|unique:users,phonenumber')] #12 characters starting with 263

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
 
  
    public function mount()
    {
        $this->admission_date = $this->admission_date ?? now()->toDateString();
       $this->graduation_date = now()->addMonths(4)->toDateString();
    }
    #mount function to facilitate dependency injection 
    #injections 

    protected UserService $user_service;
    protected StudentService $student_service;

    public function boot(UserService $user_service,StudentService $student_service)
    { 

        $this->user_service = $user_service;
        $this->student_service = $student_service;

    }

    #the data we have collected from the create form, part of it is used to create user  
    #part of the data is used to create  student 
   
    public function user_data()
    {
       return [
        'fullname'=>$this->fullname,
        'email'=>$this->email,
        'password'=>$this->password, 
        'phonenumber'=>$this->phonenumber,
        'user_type'=>$this->user_type,
        'status'=>$this->status,
       ];
    } 

    public function student_data(): array
    {
        return [
            'user_id' => '',
            'student_number' => '',
            'enrollment_status' => $this->enrollment_status,
            'gender' => $this->gender,
            'address' => $this->address,
            'city' => $this->city,
            'admission_date' => $this->admission_date,
            'graduation_date' => $this->graduation_date,
        ];
    }


    public function create_user()
    {  
        $this->validate();
        #collect data
        $user_data = $this->user_data();
        #pass data to userDTO 
        $userDTO = UserDTO::from_array($user_data);
        #pass data to service 
        $user =   $this->user_service->create($userDTO);
       // dd($user);
        #check if user was create
        if($user)
        {
          
            $student = $this->create_student($user); //creating student from user
            
            if($student)
            {
                 
                 $this->dispatch('student-created-successfully');

            }
            else{ 
                session()->flash('error', 'Failed to create student.');

            }

            
        }
        else{
            session()->flash('error', 'Failed to create user.');
        }
       
        #close function

    }//ENDOF FUNCTION
 

    #CREATE STUDENT
    public function create_student($user)
    {
        $this->dispatch('created-user');
        #create student 
        $student_data  = $this->student_data();
        $student_data['user_id'] = $user->id; 
        $student_data['student_number'] = 'ZDTI' . strtoupper(bin2hex(random_bytes(5)));
        #student dto 
        $student_dto = StudentDTO::from_array($student_data);
        #service 
        $student =  $this->student_service->create($student_dto);

        return $student;

    }//endof function 

    #render
    public function render()
    {
        return view('livewire.create-student-livewire');
    }
}
