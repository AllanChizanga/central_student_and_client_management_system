<?php

namespace App\Livewire;

use App\Models\Intake;
use Livewire\Component;

class ViewIntakeLivewire extends Component
{ 

    public $intakes = [];

    public $search;
    #boot  



    #initiate_open_add_intake_modal 
    public function initiate_open_add_intake_modal()
    {
    $this->dispatch('initiate-open-add-intake-modal');
    }


 

    #initiate_update_intake 
    public function initiate_update_intake($intake_id)
    {
        $this->dispatch('initiate_update_intake',$intake_id);
    } 



    #delete 
    public function delete()
    {
        $this->dispatch('not-authorized-to-delete');
    }
    #render
    public function render()
    {
        $query = Intake::query();

        if ($this->search) {
            $query->where('cohort', 'like', '%' . $this->search . '%');
        }

        $this->intakes = $query->orderByDesc('created_at')->get();

        return view('livewire.view-intake-livewire', [
            'intakes' => $this->intakes,
        ]);
    }//endof render 
}//endof class
