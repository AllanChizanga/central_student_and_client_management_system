<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use Livewire\Livewire;
use App\Livewire\ViewClientLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewClientTest extends TestCase
{
    use RefreshDatabase;   

    public function test_livewire_fetches_and_renders_clients_in_table()
    {
        // Arrange: create 3 fake intakes
        $clients = Client::factory()->count(3)->create();

        // Act & Assert: use Livewire to test and assert one of the cohort values is visible
        Livewire::test(ViewClientLivewire::class)
            ->assertStatus(200)
            ->assertSee($clients[0]->occupation);
    }
}
