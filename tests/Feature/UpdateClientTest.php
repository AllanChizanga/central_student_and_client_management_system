<?php

namespace Tests\Feature;

use Livewire;
use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use App\Livewire\UpdateClientLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateClientTest extends TestCase
{
   use refreshDatabase; 


   public function test_client_updates_successfully()
   {
       // Arrange: create user and client with Zimbabwean inspired data
       $user = User::factory()->create([
           'fullname'    => 'Tatenda Ndlovu',
           'email'       => 'tatenda.old@example.com',
           'phonenumber' => '263712312312',
           'user_type'   => 'client',
           'status'      => 'active',
       ]);

       $client = Client::factory()->create([
           'user_id'                        => $user->id,
           'company_name'                   => 'Harare Digital Solutions',
           'industry'                       => 'ICT',
           'lifetime_revenue_contribution'  => 1000.00,
           'country'                        => 'Zimbabwe',
           'city'                           => 'Harare',
           'occupation'                     => 'Analyst',
           'client_type'                    => 'individual',
           'client_status'                  => 'lead',
           'address'                        => '123 Mbare Street',
       ]);

       // Act: update with new Zim data
       Livewire::test(UpdateClientLivewire::class)
           ->call('handle_initiate_update_client', $client->id)
           ->set('fullname', 'Rudo Moyo')
           ->set('email', 'rudo.moyo@example.co.zw')
           ->set('phonenumber', '263777654321')
           ->set('user_type', 'client')
           ->set('status', 'active')
           ->set('company_name', 'Bulawayo FinTech Hub')
           ->set('industry', 'FinTech')
           ->set('lifetime_revenue_contribution', 25000.00)
           ->set('country', 'Zimbabwe')
           ->set('city', 'Bulawayo')
           ->set('occupation', 'Developer')
           ->set('client_type', 'organization')
           ->set('client_status', 'active')
           ->set('address', '78 Jason Moyo Avenue')
           ->call('update_client')
           ->assertHasNoErrors();

       // Assert the user record is updated with Zim data
       $this->assertDatabaseHas('users', [
           'id'          => $user->id,
           'fullname'    => 'Rudo Moyo',
           'email'       => 'rudo.moyo@example.co.zw',
           'phonenumber' => '263777654321',
           'user_type'   => 'client',
           'status'      => 'active',
       ]);

       // Assert the client record is updated with Zim data
       $this->assertDatabaseHas('clients', [
           'id'                              => $client->id,
           'company_name'                    => 'Bulawayo FinTech Hub',
           'industry'                        => 'FinTech',
           'lifetime_revenue_contribution'   => 25000.00,
           'country'                         => 'Zimbabwe',
           'city'                            => 'Bulawayo',
           'occupation'                      => 'Developer',
           'client_type'                     => 'organization',
           'client_status'                   => 'active',
           'address'                         => '78 Jason Moyo Avenue',
       ]);
   }
}
