<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Course;
use App\Models\Intake;
use Livewire\Livewire;
use App\Models\Student;
use App\Livewire\CreateEnrollmentLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateEnrollmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_enrollment_is_created_successfully()
    { 
        #create model objects
        $course = Course::factory()->create();
        $intake = Intake::factory()->create();
        $student = Student::factory()->create();
        #create fake enrollment_date and status
        $enrollment_date = now()->toDateString();
        $status = fake()->randomElement(['enrolled', 'graduated', 'dropped']);
        #livewire test 
        Livewire::test(CreateEnrollmentLivewire::class)
            ->set('student_id', $student->id)
            ->set('course_id', $course->id)
            ->set('intake_id', $intake->id)
            ->set('enrollment_date', $enrollment_date)
            ->set('status', $status)
            ->call('create_enrollment'); 

        #assert database has 
        $this->assertDatabaseHas('enrollments', [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'intake_id' => $intake->id,
            'enrollment_date' => $enrollment_date,
            'status' => $status,
        ]);
    }
}
