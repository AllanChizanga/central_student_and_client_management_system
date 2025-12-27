<?php

namespace Tests\Feature;

use Livewire;
use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Livewire\StudentLivewire;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewStudentsTest extends TestCase
{
   use RefreshDatabase; 

   public function test_students_are_being_fetched_from_database_in_manage_students_screen()
   {
       #Create 3 test students
    Student::factory()->count(3)->for(User::factory())->create();

    #Initiate Livewire component for testing and call the method
   // Call the Livewire method directly
   Livewire::test(StudentLivewire::class)
   ->call('fetch_all_students')
   ->assertSet('students_tests', function ($students) {
       $this->assertInstanceOf(Collection::class, $students);
       $this->assertCount(3, $students);
       return true;
   });

   }//endof function



   public function test_students_table_is_rendering(): void
   {
       Livewire::test(StudentLivewire::class)
           ->assertStatus(200);
        //    ->assertSee('Manage students');
   }
}//endof class
