<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;

class ViewClientLivewire extends Component
{ 
  
    #utilities 
    public $search = ''; 


    #initiate_open_add_client_modal
    public function initiate_open_add_client_modal()
    {
        $this->dispatch('initiate_open_add_client_modal');
        
    }#endof function


    #render
    public function render()
    {
        $clients = Client::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $searchTerm = '%' . $this->search . '%';
                    $query->where('company_name', 'like', $searchTerm)
                        ->orWhere('industry', 'like', $searchTerm)
                        ->orWhere('city', 'like', $searchTerm)
                        ->orWhere('country', 'like', $searchTerm)
                        ->orWhere('occupation', 'like', $searchTerm);
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.view-client-livewire', [
            'clients' => $clients,
        ]);
    }#end of render
}#end of class
