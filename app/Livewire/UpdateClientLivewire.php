<?php

namespace App\Livewire;

use App\DTOs\UserDTO;
use App\DTOs\ClientDTO;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\UserService;
use App\Services\ClientService;
use Livewire\Attributes\Validate;

class UpdateClientLivewire extends Component
{ 

    #client attributes 
    #[Validate('required|string|max:255')]
    public $company_name;

    #[Validate('required|string|max:255')]
    public $industry;

    #[Validate('required|numeric|min:0|max:9999999999999.99')]
    public $lifetime_revenue_contribution = 0.00;

    #[Validate('required|string|max:255')]
    public $country;

    #[Validate('required|string|max:255')]
    public $city;

    #[Validate('nullable|string|max:255')]
    public $occupation;

    #[Validate('nullable|string|max:255')]
    public $address;

    #[Validate('required|in:individual,organization')]
    public $client_type;

    #[Validate('required|in:lead,active,completed')]
    public $client_status = 'active';

    #user attributes 
    #[Validate('required|string|max:255')]
    public $fullname;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('required|string|size:12|regex:/^2637[0-9]{8}$/')]
    public $phonenumber;

    #[Validate('required|in:student,client,lead,admin,superuser')]
    public $user_type = 'client';

    #[Validate('required|in:active,inactive,suspended')]
    public $status = 'active';

    #user id created after user is created 
    public $user_id;
    public $client_id;

    #models 
    public $user; 

    public $client;

    #boot 
    protected UserService $user_service;
    protected ClientService $client_service;
    public function boot(UserService $user_service,ClientService $client_service)
    { 

        $this->user_service = $user_service;
        $this->client_service = $client_service;
       

    }


    #user to array 
    public function user_to_array()
    {
       return [
           'id' => $this->user->id,
           'fullname'    => $this->fullname ?? ($this->user->fullname ?? null),
           'email'       => $this->email ?? ($this->user->email ?? null),
           'phonenumber' => $this->phonenumber ?? ($this->user->phonenumber ?? null),
           'user_type'   => $this->user_type ?? ($this->user->user_type ?? 'client'),
           'status'      => $this->status ?? ($this->user->status ?? 'active'),
           'password'    => $this->user->password ?? null,
       ];
    } 

    #client to array 
    public function client_to_array(): array
    {
        return [
            'id' =>$this->client->id,
            'user_id' => $this->user_id ?? ($this->client->user_id ?? null),
            'company_name' => $this->company_name ?? ($this->client->company_name ?? null),
            'industry' => $this->industry ?? ($this->client->industry ?? null),
            'lifetime_revenue_contribution' => $this->lifetime_revenue_contribution ?? ($this->client->lifetime_revenue_contribution ?? null),
            'country' => $this->country ?? ($this->client->country ?? null),
            'city' => $this->city ?? ($this->client->city ?? null),
            'occupation' => $this->occupation ?? ($this->client->occupation ?? null),
            'client_type' => $this->client_type ?? ($this->client->client_type ?? null),
            'client_status' => $this->client_status ?? ($this->client->client_status ?? null),
            'address' => $this->address ?? ($this->client->address ?? null),
        ];
    }


    #update user 

   public function update_user_only()
    {
       
        #pass data to userDTO 
        $userDTO = UserDTO::from_array($this->user_to_array());
        #pass data to service 
        $user =   $this->user_service->update($userDTO);
        $this->user_id = $user->id;

        return $user;
    }
    #update client 
    public function update_client_only()
    {
        // Pass client data to ClientDTO
        $client_dto = ClientDTO::from_array($this->client_to_array());

        // Call the client service to create the client
        $client = $this->client_service->update($client_dto);

        return $client;
    }

    #update client  
    public function update_client()
    {
        $this->validate();

        // Create the user first
        $user = $this->update_user_only();

        if (!$user) {
            session()->flash('error', 'Failed to update user.');
            return;
        }

        $this->user_id = $user->id;

        // Create the client
        $client = $this->update_client_only();

        if ($client) {
            $this->dispatch('client-updated-successfully');
        } else {
            session()->flash('error', 'Failed to update client.');
        }
    }


    #events 
    #[On('initiate_update_client')]
    public function handle_initiate_update_client($client_id): void
    { 
        
        $client = $this->client_service->fetch_one_with_user($client_id);
        if ($client) {
           
            $this->client = $client;
            // Fill client attributes
            $this->client_id = $client->id;
            $this->company_name = $client->company_name;
            $this->industry = $client->industry;
            $this->lifetime_revenue_contribution = $client->lifetime_revenue_contribution;
            $this->country = $client->country;
            $this->city = $client->city;
            $this->occupation = $client->occupation;
            $this->client_type = $client->client_type;
            $this->client_status = $client->client_status;
            $this->address = $client->address;

            // Fill user attributes if loaded
            if ($client->user) { 
               
                $this->user = $client->user;
                $this->user_id = $client->user->id;
                $this->fullname = $client->user->fullname;
                $this->email = $client->user->email;
                $this->phonenumber = $client->user->phonenumber;
                $this->user_type = $client->user->user_type;
                $this->status = $client->user->status;
            }
        }
        $this->dispatch('view-update-client-modal');
    }
    public function render()
    {
        return view('livewire.update-client-livewire');
    }
}
