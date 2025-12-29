<?php

namespace Tests\Feature;

use Livewire;
use Tests\TestCase;
use App\Livewire\CreateClientLivewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateClientTest extends TestCase
{ 


    use refreshDatabase; 

    public function test_client_is_successfully_creating()
    { 
        // Arrange: set up fake attributes for the user and client
        $attributes = [
            'company_name' => 'Zim Digital Solutions',
            'industry' => 'Telecommunications',
            'lifetime_revenue_contribution' => 825104.75,
            'country' => 'Zimbabwe',
            'city' => 'Bulawayo',
            'occupation' => 'ICT Consulting',
            'address' => '45 Jason Moyo Avenue',
            'client_type' => 'organization',
            'client_status' => 'active',

            'fullname' => 'Tendai Moyo',
            'email' => 'tendai.moyo@zimdigital.co.zw',
            'phonenumber' => '263778654321',
            'user_type' => 'client',
            'status' => 'active',
        ];

        // Act: call the Livewire component and submit the form
        Livewire::test(CreateClientLivewire::class)
            ->set('company_name', $attributes['company_name'])
            ->set('industry', $attributes['industry'])
            ->set('lifetime_revenue_contribution', $attributes['lifetime_revenue_contribution'])
            ->set('country', $attributes['country'])
            ->set('city', $attributes['city'])
            ->set('occupation', $attributes['occupation'])
            ->set('address', $attributes['address'])
            ->set('client_type', $attributes['client_type'])
            ->set('client_status', $attributes['client_status'])
            ->set('fullname', $attributes['fullname'])
            ->set('email', $attributes['email'])
            ->set('phonenumber', $attributes['phonenumber'])
            ->set('user_type', $attributes['user_type'])
            ->set('status', $attributes['status'])
            ->call('create_client')
            ->assertHasNoErrors();

        // Assert: user exists in the users table
        $this->assertDatabaseHas('users', [
            'fullname' => $attributes['fullname'],
            'email' => $attributes['email'],
            'phonenumber' => $attributes['phonenumber'],
            'user_type' => $attributes['user_type'],
            'status' => $attributes['status'],
        ]);

        // Assert: client exists in the clients table
        $this->assertDatabaseHas('clients', [
            'company_name' => $attributes['company_name'],
            'industry' => $attributes['industry'],
            'lifetime_revenue_contribution' => $attributes['lifetime_revenue_contribution'],
            'country' => $attributes['country'],
            'city' => $attributes['city'],
            'occupation' => $attributes['occupation'],
            'client_type' => $attributes['client_type'],
            'client_status' => $attributes['client_status'],
            'address' => $attributes['address'],
        ]);

    }
    
}
