<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cable;
use Illuminate\Validation\Rule;

class CableEdit extends Component
{
    public $cable; // The Cable model instance
    public $label;
    public $circ_id;
    public $status;
    public $voltage;
    public $op_area;
    public $from_info;
    public $to_info;
    public $FromToName;
    public $SubstationLabel;
    public $cable_type;
    public $route_length;
    public $FromLabel;
    public $ToLabel;
    public $latitude;
    public $longitude;

    public $mapUrl; // For displaying the map preview

    protected function rules()
    {
        return [
            'label' => 'required|string|max:255',
            'circ_id' => 'required|string|max:255|unique:cables,circ_id,' . $this->cable->id,
            'status' => ['required', Rule::in(['Existing', 'Inactive', 'Abandoned'])],
            'voltage' => 'required|string|max:50',
            'op_area' => 'nullable|string|max:255',
            'from_info' => 'nullable|string|max:255',
            'to_info' => 'nullable|string|max:255',
            'FromToName' => 'nullable|string|max:255',
            'SubstationLabel' => 'nullable|string|max:255',
            'cable_type' => 'nullable|string|max:255',
            'route_length' => 'nullable|numeric|min:0',
            'FromLabel' => 'nullable|string|max:255',
            'ToLabel' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ];
    }

    // Mount method to initialize properties from the existing cable
    public function mount(Cable $cable)
    {
        $this->cable = $cable;

        $this->label = $cable->label;
        $this->circ_id = $cable->circ_id;
        $this->status = $cable->status;
        $this->voltage = $cable->voltage;
        $this->op_area = $cable->op_area;
        $this->from_info = $cable->from_info;
        $this->to_info = $cable->to_info;
        $this->FromToName = $cable->FromToName;
        $this->SubstationLabel = $cable->SubstationLabel;
        $this->cable_type = $cable->cable_type;
        $this->route_length = $cable->route_length;
        $this->FromLabel = $cable->FromLabel;
        $this->ToLabel = $cable->ToLabel;
        $this->latitude = $cable->latitude;
        $this->longitude = $cable->longitude;

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

    // Save method to update the cable details
    public function save()
    {
        $this->validate();

        $this->cable->update([
            'label' => $this->label,
            'circ_id' => $this->circ_id,
            'status' => $this->status,
            'voltage' => $this->voltage,
            'op_area' => $this->op_area,
            'from_info' => $this->from_info,
            'to_info' => $this->to_info,
            'FromToName' => $this->FromToName,
            'SubstationLabel' => $this->SubstationLabel,
            'cable_type' => $this->cable_type,
            'route_length' => $this->route_length,
            'FromLabel' => $this->FromLabel,
            'ToLabel' => $this->ToLabel,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        session()->flash('message', 'Cable updated successfully!');

        return redirect()->route('cable show', $this->cable->id);
    }

    // Cancel method to go back without saving
    public function cancel()
    {
        return redirect()->route('cable show', $this->cable->id);
    }

    public function render()
    {
        return view('livewire.cable-edit');
    }
}