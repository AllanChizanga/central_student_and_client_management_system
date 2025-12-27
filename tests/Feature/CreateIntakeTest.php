<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\CreateIntakeLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateIntakeTest extends TestCase
{
    use RefreshDatabase;   


    
       #one
       public function test_create_intake_modal_screen_is_opening()
       {
           Livewire::test(CreateIntakeLivewire::class)
           ->assertStatus(200);
       
       }#endof function   

    public function test_intake_is_created_successfully()
    {
        $fakeCohort = 'Cohort ' . fake()->word();
        $fakeStartDate = now()->toDateString();
        $fakeGraduationDate = now()->addMonths(6)->toDateString();

        Livewire::test(CreateIntakeLivewire::class)
            ->set('cohort', $fakeCohort)
            ->set('start_date', $fakeStartDate)
            ->set('graduation_date', $fakeGraduationDate)
            ->call('create_intake');

        $this->assertDatabaseHas('intakes', [
            'cohort' => $fakeCohort,
            'start_date' => $fakeStartDate,
            'graduation_date' => $fakeGraduationDate,
        ]);
    }
}#class
