<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cable; // Changed to Cable model

class CableShow extends Component // Renamed class
{
    public $cable; // Changed property name to 'cable'

    public function mount(Cable $cable) // Changed parameter to Cable model for route model binding
    {
        // The cable is already resolved by Laravel
        $this->cable = $cable;
    }

    public function render()
    {
        return view('livewire.cable-show'); // Changed view name
    }
}
