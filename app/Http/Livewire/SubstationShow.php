<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Substation;
use App\Models\BreakdownRecord; // Import the BreakdownRecord model

class SubstationShow extends Component
{
    public $substation;
    public $mapUrl;
    public $breakdownRecords; // Property to hold breakdown records

    public function mount(Substation $substation)
    {
        $this->substation = $substation; // The model is already resolved by Laravel
        
        // This part remains the same, as $this->substation is now correctly populated
        if ($this->substation->latitude && $this->substation->longitude) {
            $this->mapUrl = "https://www.google.com/maps/search/?api=1&query={$this->substation->latitude},{$this->substation->longitude}";
        } else {
             $this->mapUrl = null; // Ensure it's null if no coordinates
        }

        // Eager load the breakdown records for this substation
        $this->substation->load('breakdownRecords');
        $this->breakdownRecords = $this->substation->breakdownRecords;
    }

    public function render()
    {
        return view('livewire.substation-show');
    }

    // You might need a delete method if you want to allow deleting substations directly from this view
    public function delete(Substation $substation)
    {
        $substation->delete();
        session()->flash('message', 'Substation deleted successfully.');
        return redirect()->route('substations'); // Redirect to the substation list after deletion
    }
}