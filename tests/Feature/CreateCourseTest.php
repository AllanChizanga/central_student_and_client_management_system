<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;
use App\Livewire\CreateCourseLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCourseTest extends TestCase
{ 

    use RefreshDatabase; 



    #one
    public function test_create_course_modal_screen_is_opening()
    {
        Livewire::test(CreateCourseLivewire::class)
        ->assertStatus(200);
    
    }#endof function  



    #two 
public function test_course_is_created_successfully()
{
    $syllabus = UploadedFile::fake()->create('syllabus.pdf', 1000, 'application/pdf');

    Livewire::test(CreateCourseLivewire::class)
        ->set('name', 'Introduction to Laravel')
        ->set('category', 'Software Engineering')
        ->set('active', true)
        ->set('duration_months', 12)
        ->set('mode_of_learning', 'Evening Online')
        ->set('total_fee', 800.00)
        ->set('fee_currency', 'USD')
        ->set('monthly_fee', 80.00)
        ->set('syllabus_pdf', $syllabus)
        ->set('summary', 'Comprehensive course about Laravel fundamentals.')
        ->set('prerequisites', 'Basic PHP knowledge.')
        ->set('weekly_schedule', 'Mondays and Wednesdays, 6-8pm')
        ->set('grading', 'Continuous assessment and final project.')
        ->set('type_of_assessments', 'Assignments, Quizzes, Project')
        ->call('create_course');

    $this->assertDatabaseHas('courses', [
        'name' => 'Introduction to Laravel',
        'category' => 'Software Engineering',
    ]);
}
    
   
}#end class
