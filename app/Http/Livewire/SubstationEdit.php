<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Substation;
use Illuminate\Validation\Rule;

class SubstationEdit extends Component
{
    public $substation; // The Substation model instance
    public $name;
    public $functional_location;
    public $status;
    public $voltage;
    public $operational_area;
    public $owner_type;
    public $owner_name;
    public $design;
    public $category;
    public $status_act;
    public $latitude;
    public $longitude;
    public $label;

    public $mapUrl; // For displaying the map preview

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'functional_location' => 'required|string|max:255|unique:substations,functional_location,' . $this->substation->id,
            'status' => ['required', Rule::in(['Existing', 'Inactive', 'Abandoned'])],
            'voltage' => 'required|string|max:50', // Allows "33/11", "132", etc.
            'operational_area' => 'nullable|string|max:255',
            'owner_type' => 'nullable|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'design' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'status_act' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'label' => 'nullable|string|max:255',
        ];
    }

    // Mount method to initialize properties from the existing substation
    public function mount(Substation $substation)
    {
        $this->substation = $substation;

        $this->name = $substation->name;
        $this->functional_location = $substation->functional_location;
        $this->status = $substation->status;
        $this->voltage = $substation->voltage;
        $this->operational_area = $substation->operational_area;
        $this->owner_type = $substation->owner_type;
        $this->owner_name = $substation->owner_name;
        $this->design = $substation->design;
        $this->category = $substation->category;
        $this->status_act = $substation->status_act;
        $this->latitude = $substation->latitude;
        $this->longitude = $substation->longitude;
        $this->label = $substation->label;

        $this->updateMapUrl();
    }

    // Update map URL whenever latitude or longitude changes
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['latitude', 'longitude'])) {
            $this->updateMapUrl();
        }
    }

    private function updateMapUrl()
    {
        if ($this->latitude && $this->longitude) {
            $this->mapUrl = "https://www.google.com/maps/search/?api=1&query={$this->latitude},{$this->longitude}";
        } else {
            $this->mapUrl = null;
        }
    }

    // Save method to update the substation details
    public function save()
    {
        $this->validate();

        $this->substation->update([
            'name' => $this->name,
            'functional_location' => $this->functional_location,
            'status' => $this->status,
            'voltage' => $this->voltage,
            'operational_area' => $this->operational_area,
            'owner_type' => $this->owner_type,
            'owner_name' => $this->owner_name,
            'design' => $this->design,
            'category' => $this->category,
            'status_act' => $this->status_act,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'label' => $this->label,
        ]);

        session()->flash('message', 'Substation updated successfully!');

        return redirect()->route('substation show', $this->substation->id);
    }

    // Cancel method to go back without saving
    public function cancel()
    {
        return redirect()->route('substation show', $this->substation->id);
    }

    public function render()
    {
        return view('livewire.substation-edit');
    }
}