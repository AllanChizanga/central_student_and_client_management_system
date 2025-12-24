<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\DTOs\UserDTO;
use App\DTOs\StudentDTO;
use App\Services\UserService;
use App\Services\StudentService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateStudentTest extends TestCase
{ 
  use refreshDatabase;
  
    private $student_service;
    private $user_service;
    

    protected function setUp(): void
    {
        parent::setUp();
        $this->app->loadEnvironmentFrom('.env.testing');
         $this->student_service = app(StudentService::class);
         $this->user_service = app(UserService::class);

    }

    public function test_user_is_successfully_being_created_by_admin()
    {  
        #create a user dto 
        $user_dto = UserDTO::from_array([
            'fullname' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'phonenumber' => '1234567890',
            'user_type' => 'student',
            'status' => 'active',
        ]);

        #pass to user service 
        $user = $this->user_service->create($user_dto);

      
        #create a student dto
        $student_dto = StudentDTO::from_array([
            'user_id'=>$user->id,
            'student_number' => 'ZDTI12345',
            'enrollment_status' => 'enrolled',
            'admission_date' => now()->toDateString(),
            'graduation_date' => now()->addMonths(4)->toDateString(),
            'gender' => 'male',
            'address' => '123 Main Street',
            'city' => 'Sample City',
        ]);
     
        #pass student to service
        $student = $this->student_service->create($student_dto);

          #assert returns valid user 
          $this->assertNotNull($user);
          $this->assertEquals('John Doe', $user->fullname);
          $this->assertEquals('john@example.com', $user->email);
        $this->assertNotNull($student);
        $this->assertEquals('ZDTI12345', $student->student_number);
      

    }//endof function
}//endof class
