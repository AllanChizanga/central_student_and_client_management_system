<?php

namespace App\Livewire;

use Hash;
use App\DTOs\UserDTO;
use App\DTOs\ClientDTO;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\UserService;
use App\Services\ClientService;
use Livewire\Attributes\Validate;

class CreateClientLivewire extends Component
{  
    #attributes from model client 

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

    #attributes from user model  
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
        'fullname'=>$this->fullname,
        'email'=>$this->email,
        'phonenumber'=>$this->phonenumber,
        'user_type'=>$this->user_type,
        'status'=>$this->status,
       'password' => Hash::make('zomac_client'),
       ];
    } 

    #client to array 
    public function client_to_array(): array
    {
        return [
            'user_id' => $this->user_id,
            'company_name' => $this->company_name,
            'industry' => $this->industry,
            'lifetime_revenue_contribution' => $this->lifetime_revenue_contribution,
            'country' => $this->country,
            'city' => $this->city,
            'occupation' => $this->occupation,
            'client_type' => $this->client_type,
            'client_status' => $this->client_status,
        ];
    }


    #create user only
    public function create_user_only()
    {
       
        #pass data to userDTO 
        $userDTO = UserDTO::from_array($this->user_to_array());
        #pass data to service 
        $user =   $this->user_service->create($userDTO);
        $this->user_id = $user->id;

        return $user;
    }

    #create client only
    public function create_client_only()
    {
        // Pass client data to ClientDTO
        $client_dto = ClientDTO::from_array($this->client_to_array());

        // Call the client service to create the client
        $client = $this->client_service->create($client_dto);

        return $client;
    }

    #create_client 
    public function create_client()
    {
        $this->validate();

        // Create the user first
        $user = $this->create_user_only();

        if (!$user) {
            session()->flash('error', 'Failed to create user.');
            return;
        }

        $this->user_id = $user->id;

        // Create the client
        $client = $this->create_client_only();

        if ($client) {
            $this->dispatch('client-created-successfully');
        } else {
            session()->flash('error', 'Failed to create client.');
        }
    }


    #event handler 
    #[On('initiate_open_add_client_modal')]
    public function handle_initiate_open_add_client_modal(): void
    {
        $this->dispatch('view-create-client-modal');
    }

    #render
    public function render()
    {
        return view('livewire.create-client-livewire');
    }
}
