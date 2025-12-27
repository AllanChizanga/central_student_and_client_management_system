<?php

namespace Tests\Feature;

use Livewire;
use Tests\TestCase;
use App\Models\Course;
use Illuminate\Http\UploadedFile;
use App\Livewire\UpdateCourseLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCourseTest extends TestCase
{ 

    use  RefreshDatabase;
   
    #one
    public function test_update_course_screen_is_opening()
    {
        Livewire::test(UpdateCourseLivewire::class)
        ->assertStatus(200);
    
    }#endof function  

    public function test_course_can_be_updated_and_persists_changes()
    {
        // 1. Create a fake course
        $course = Course::factory()->create([
            'name' => 'Original Name',
            'category' => 'Software Engineering',
            'active' => true,
            'duration_months' => 6,
            'mode_of_learning' => 'Evening Online',
            'total_fee' => 1000.00,
            'fee_currency' => 'USD',
            'monthly_fee' => 200.00,
            'syllabus_pdf' => 'original-syllabus.pdf',
            'summary' => 'Original summary content.',
            'prerequisites' => 'None',
            'weekly_schedule' => 'Monday 6pm',
            'grading' => 'Standard',
            'type_of_assessments' => 'Exams',
        ]);

        // 2. Set new values for name and summary compactly
       

        Livewire::test(UpdateCourseLivewire::class)
        ->set('course', $course)
        ->set('name', 'Course Name')
        ->set('category', 'Cybersecurity')
        ->set('active', false)
        ->set('duration_months', 12)
        ->set('mode_of_learning', 'Day In Person')
        ->set('total_fee', 2000.00)
        ->set('fee_currency', 'ZWL')
        ->set('monthly_fee', 250.00)
        ->set('syllabus_pdf', $course->syllabus_pdf) // simulate unchanged file
        ->set('summary', 'Course Summary')
        ->set('prerequisites', 'Some prerequisites')
        ->set('weekly_schedule', 'Tuesday and Thursday 5pm')
        ->set('grading', 'Updated Grading Policy')
        ->set('type_of_assessments', 'Assignments and Exams')
        ->call('update_course');
           

        // 3. Assert database has updated name and summary only
        $this->assertDatabaseHas('courses', [
            'id' => $course->id,
            'name' => 'Course Name',
            'summary' => 'Course Summary',
        ]);
    }











    #two 
    

}
