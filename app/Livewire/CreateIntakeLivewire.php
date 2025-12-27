<?php

namespace App\Livewire;

use App\DTOs\IntakeDTO;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\IntakeService;
use Livewire\Attributes\Validate;

class CreateIntakeLivewire extends Component
{  


    #[Validate('required|string|max:191')]
    public string $cohort;

    #[Validate('required|date|before_or_equal:graduation_date')]
    public string $start_date;

    #[Validate('required|date|after_or_equal:start_date')]
    public string $graduation_date;


    #boot
    protected IntakeService $intake_service;

    public function boot(IntakeService $intake_service): void
    {
        $this->intake_service = $intake_service;
    }



    #initiate-open-add-intake-modal
    #[On('initiate-open-add-intake-modal')]
    public function handle_initial_open_add_intake_modal_event(): void
    {
         $this->dispatch('view-create-intake-modal');
    } 



 
    protected function intake_array_data(): array
    {
        return [
            'cohort' => $this->cohort,
            'start_date' => $this->start_date,
            'graduation_date' => $this->graduation_date,
        ];
    }



    #create_intake 
    public function create_intake()
    { 
        #validate 
        $this->validate();
        #collect data 
        $data = $this->intake_array_data();
        #pass to dto 
        $intake_dto = IntakeDTO::from_array($data);
        #pass to service 
        $intake = $this->intake_service->create($intake_dto);
        #feedback 
        if(!$intake)
        {
            session()->flash('error','Failed To Create Intake');
        }
        else
        { 

            $this->dispatch('intake-created-successfully');

        }

    }



    #render
    public function render()
    {
        return view('livewire.create-intake-livewire');
    }
}
