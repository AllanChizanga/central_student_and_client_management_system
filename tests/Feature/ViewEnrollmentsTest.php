<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Enrollment;
use App\Livewire\ViewEnrollmentLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewEnrollmentsTest extends TestCase
{
    use RefreshDatabase;   

    public function test_livewire_fetches_and_renders_enrollments_in_table()
    {
        // Arrange: create 3 fake intakes
        $intakes = Enrollment::factory()->count(3)->create();

        // Act & Assert: use Livewire to test and assert one of the cohort values is visible
        Livewire::test(ViewEnrollmentLivewire::class)
            ->assertStatus(200)
            ->assertSee($intakes[0]->cohort);
    }
   
}
