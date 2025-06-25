<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Substation;

class SubstationCreate extends Component
{
    public $name;
    public $functional_location;
    public $status = 'active';
    public $voltage;
    public $design;
    public $operational_area;
    public $latitude;
    public $longitude;
    public $description;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'functional_location' => 'required|min:3|max:255|unique:substations',
        'status' => 'required|in:active,inactive,maintenance,backup',
        'voltage' => 'required|numeric|min:0',
        'design' => 'required|in:gis,ais,hybrid,outdoor,indoor',
        'operational_area' => 'required|min:3|max:255',
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
        'description' => 'nullable|max:500'
    ];

    protected $messages = [
        'functional_location.unique' => 'This functional location already exists',
        'latitude.between' => 'Latitude must be between -90 and 90',
        'longitude.between' => 'Longitude must be between -180 and 180',
    ];

    public function detectLocation()
    {
        $this->dispatchBrowserEvent('detecting-location');

        if (env('APP_ENV') === 'local') {
            // Mock location for development
            $this->latitude = 3.1390;
            $this->longitude = 101.6869;
            $this->dispatchBrowserEvent('location-detected', [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude
            ]);
        }
        // For production, the actual geolocation detection should be handled in JavaScript
        // and the result sent back to Livewire via events or AJAX.
    }

    public function save()
    {
        $this->validate();

        Substation::create([
            'name' => $this->name,
            'functional_location' => $this->functional_location,
            'status' => $this->status,
            'voltage' => $this->voltage,
            'design' => $this->design,
            'operational_area' => $this->operational_area,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'description' => $this->description
        ]);

        session()->flash('success', 'Substation created successfully!');
        
        return redirect()->route('substations.index');
    }

    public function render()
    {
        return view('livewire.substation-create');
    }
}