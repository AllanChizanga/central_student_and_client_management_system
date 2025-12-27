<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Intake;
use Livewire\Livewire;
use App\Livewire\UpdateIntakeLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateIntakeTest extends TestCase
{
    use  RefreshDatabase;
   
    #one
    public function test_update_intake_screen_is_opening()
    {
        Livewire::test(UpdateIntakeLivewire::class)
        ->assertStatus(200);
    
    }#endof function  

    public function test_update_intake_updates_intake_attributes()
    {
        // 1. create fake intake
        $intake = Intake::factory()->create();

        // 2. set new values for UpdateIntakeLivewire attributes including id from fake intake
        $newCohort = 'Updated Cohort 99XY';
        $newStartDate = now()->addMonth()->format('Y-m-d');
        $newGraduationDate = now()->addMonths(6)->format('Y-m-d');

        Livewire::test(UpdateIntakeLivewire::class)
            ->call('fetch_and_load_intake', $intake->id)
            ->set('cohort', $newCohort)
            ->set('start_date', $newStartDate)
            ->set('graduation_date', $newGraduationDate)
            ->call('update_intake');

        // assertDatabaseHas
        $this->assertDatabaseHas('intakes', [
            'id' => $intake->id,
            'cohort' => $newCohort,
            'start_date' => $newStartDate,
            'graduation_date' => $newGraduationDate,
            'deleted_at' => null,
        ]);
    }
}
