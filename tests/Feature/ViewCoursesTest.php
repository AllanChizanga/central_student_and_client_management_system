<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Course;
use Livewire\Livewire;
use App\Livewire\ViewCourseLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewCoursesTest extends TestCase
{
   
public function test_livewire_fetches_and_renders_courses_in_table()
{
    // Arrange: create 3 fake courses
    $courses = Course::factory()->count(3)->create();

    // Act: test the Livewire component and assert the page loads successfully
    Livewire::test(ViewCourseLivewire::class)
        ->assertStatus(200)
        // Assert one of the course names is present
        ->assertSee($courses[0]->name);
}//endof function
}//endof class
