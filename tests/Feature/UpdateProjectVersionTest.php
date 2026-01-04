<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use App\Models\ProjectVersion;
use Livewire\Livewire;
use App\Livewire\UpdateProjectVersionLivewire;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProjectVersionTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_project_version_screen_is_opening()
    {
        Livewire::test(UpdateProjectVersionLivewire::class)
            ->assertStatus(200);
    }

    public function test_update_project_version_updates_project_version_attributes()
    { 
        $this->withoutExceptionHandling();
        // 1. create fake client & project_version
        $client = Client::factory()->create();
        $projectVersion = ProjectVersion::factory()->create([
            'client_id' => $client->id,
        ]);
        $newVersionName = 'Updated Version '.fake()->word();
     
        $response = Livewire::test(UpdateProjectVersionLivewire::class)
            ->call('handle_initiate_open_edit_project_version_modal', $projectVersion->id)
            ->set('project_version_name', $newVersionName)
            ->call('update_project_version'); 
         //dd($response);

        // assertDatabaseHas
        $this->assertDatabaseHas('project_versions', [
            'id' => $projectVersion->id,
            'client_id' => $client->id,
            'project_version_name' => $newVersionName,
         
        ]);
    }
}
