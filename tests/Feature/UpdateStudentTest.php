<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Student;
use App\Livewire\UpdateStudentLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateStudentTest extends TestCase
{
    use RefreshDatabase;

    // tests 

    public function test_update_student_screen_is_opening()
    {
        Livewire::test(UpdateStudentLivewire::class)
        ->assertStatus(200);
    
    }#endof function 



    #two 
    public function test_student_is_being_updated_successfully()
    { 

        

    $student = Student::factory()->for(User::factory())->create();

    Livewire::test(UpdateStudentLivewire::class)
        // User properties
        ->set('user_id', $student->user->id)
        ->set('fullname', $student->user->fullname)
        ->set('email', $student->user->email)
        ->set('phonenumber', $student->user->phonenumber)
        ->set('user_type', $student->user->user_type)
        ->set('status', $student->user->status)
        // Student properties
        ->set('student_id', $student->id)
        ->set('student_number', $student->student_number)
        ->set('enrollment_status', $student->enrollment_status)
        ->set('gender', $student->gender)
        ->set('address', $student->address)
        ->set('city', $student->city)
        ->set('admission_date', $student->admission_date)
        ->set('graduation_date', $student->graduation_date)
        ->call('update');

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'address' =>$student->address,
        ]);
    
       
    }#endof function

}#endof class
