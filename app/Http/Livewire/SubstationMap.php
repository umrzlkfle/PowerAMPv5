<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Substation; // Make sure to import your Substation model

class SubstationMap extends Component
{
    public $substations;
    public $selectedSubstation = null;

    public function mount()
    {
        $this->substations = Substation::all();
    }

    public function selectSubstation($substationId)
    {
        $this->selectedSubstation = Substation::find($substationId);

        // Emit an event to the JavaScript on the front end to update the map
        $this->dispatch('substationSelected', [
            'latitude' => $this->selectedSubstation->latitude,
            'longitude' => $this->selectedSubstation->longitude,
            'name' => $this->selectedSubstation->name,
        ]);
    }

    public function render()
    {
        return view('livewire.substation-map');
    }
}