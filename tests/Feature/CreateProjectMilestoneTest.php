<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\ProjectVersion;
use Illuminate\Foundation\Testing\WithFaker;
use App\Livewire\CreateProjectMilestoneLivewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectMilestoneTest extends TestCase
{ 

    
    use RefreshDatabase;   


    
       #one
       public function test_create_project_milestone_modal_screen_is_opening()
       {
           Livewire::test(CreateProjectMilestoneLivewire::class)
           ->assertStatus(200);
       
       }#endof function   

    public function test_project_milestone_is_created_successfully()
    {
        $project_version = ProjectVersion::factory()->create();
         //variables 
         $title = 'Authentication';
         $deliverables = 'Deliverables Akawanda';
         $duration_days = 5;
         $amount = 250.00;
         $payment_status = 'pending';
         $due_date = '2026-02-18 00:00:00';
         $developers_notes = 'Developers Notes ';

        Livewire::test(CreateProjectMilestoneLivewire::class)
            ->set('project_version_id', $project_version->id)
            ->set('title', $title)
            ->set('deliverables', $deliverables)
            ->set('duration_days', $duration_days)
            ->set('amount', $amount)
            ->set('payment_status', $payment_status)
            ->set('due_date', $due_date)
            ->set('developers_notes', $developers_notes)
            ->call('create_project_milestone');

        $this->assertDatabaseHas('project_milestones', [
            'project_version_id' => $project_version->id,
            'title' => $title,
            'deliverables' => $deliverables,
            'duration_days' => $duration_days,
            'amount' => $amount,
            'payment_status' => $payment_status,
            'due_date' => $due_date,
            'developers_notes' => $developers_notes,
        ]);
    }
}
