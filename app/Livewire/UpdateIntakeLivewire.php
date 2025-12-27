<?php

namespace App\Livewire;

use App\Models\Intake;
use App\DTOs\IntakeDTO;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\IntakeService;
use Livewire\Attributes\Validate;

class UpdateIntakeLivewire extends Component
{  

    #attributes 
    #[Validate('required|string|max:191')]
    public string $cohort;

    #[Validate('required|date|before_or_equal:graduation_date')]
    public string $start_date;

    #[Validate('required|date|after_or_equal:start_date')]
    public string $graduation_date;
    
    public $intake;


    #boot 
    protected IntakeService $intake_service;

    public function boot(IntakeService $intake_service): void
    {
        $this->intake_service = $intake_service;
    } 


    #
    public function fetch_and_load_intake(string $intake_id): void
    {
        $intake = Intake::find($intake_id);
        $this->intake = $intake;

        if ($intake) {
            $this->cohort = $intake->cohort;
            $this->start_date = $intake->start_date;
            $this->graduation_date = $intake->graduation_date;
        } else {
            session()->flash('error', 'Unable to load intake for update.');
        }
    }
   
    #[On('initiate_update_intake')]
    public function handle_initiate_update_intake_event($intake_id): void
    { 
        $this->fetch_and_load_intake($intake_id);

        $this->dispatch('view-update-intake-modal');
    } 




    #intake data 
    protected function intake_array_data(): array
    {
        return [
            'id'=>$this->intake->id,
            'cohort' => $this->cohort,
            'start_date' => $this->start_date,
            'graduation_date' => $this->graduation_date,
        ];
    }


    #update intake 
    public function update_intake()
    { 
        #validate 
        $this->validate();
        #collect data 
        $data = $this->intake_array_data();
        #pass to dto 
        $intake_dto = IntakeDTO::from_array($data);
        #pass to service 
        $intake = $this->intake_service->update($intake_dto);
        #feedback 
        if(!$intake)
        {
            session()->flash('error','Failed To update Intake');
        }
        else
        { 

            $this->dispatch('intake-updated-successfully');

        }

    }

    

    #render
    public function render()
    {
        return view('livewire.update-intake-livewire');
    }
}
