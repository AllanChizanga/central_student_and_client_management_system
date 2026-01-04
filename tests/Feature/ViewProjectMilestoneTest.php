<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\ProjectMilestone;
use Illuminate\Foundation\Testing\WithFaker;
use App\Livewire\ViewProjectMilestoneLivewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewProjectMilestoneTest extends TestCase
{
  
    use RefreshDatabase;   

    public function test_livewire_fetches_and_renders_milestones_in_table()
    {
        // Arrange: create 3 fake intakes
        $project_milestones = ProjectMilestone::factory()->count(3)->create();

        // Act & Assert: use Livewire to test and assert one of the cohort values is visible
        Livewire::test(ViewProjectMilestoneLivewire::class)
            ->assertStatus(200)
            ->assertSee($project_milestones[0]->deliverables);
    }
}
