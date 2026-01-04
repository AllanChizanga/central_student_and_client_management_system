<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\ProjectVersion;
use App\Livewire\ViewProjectVersionLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewProjectVersionTest extends TestCase
{ 


    use RefreshDatabase;   

    public function test_livewire_fetches_and_renders_project_versions_in_table()
    {
        // Arrange: create 3 fake projects versions
        $project_versions = ProjectVersion::factory()->count(3)->create();

        // Act & Assert: use Livewire to test and assert one of the cohort values is visible
        Livewire::test(ViewProjectVersionLivewire::class)
            ->assertStatus(200)
            ->assertSee($project_versions[0]->project_version_name);
    }

}//end of test classs 
