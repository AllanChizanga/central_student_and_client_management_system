<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Intake;
use Livewire\Livewire;
use App\Livewire\ViewIntakeLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewIntakeTest extends TestCase
{ 

    use RefreshDatabase;   

    public function test_livewire_fetches_and_renders_intakes_in_table()
    {
        // Arrange: create 3 fake intakes
        $intakes = Intake::factory()->count(3)->create();

        // Act & Assert: use Livewire to test and assert one of the cohort values is visible
        Livewire::test(ViewIntakeLivewire::class)
            ->assertStatus(200)
            ->assertSee($intakes[0]->cohort);
    }
   
}
