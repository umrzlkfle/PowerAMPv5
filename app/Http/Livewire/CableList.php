<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cable;
use Livewire\WithPagination;

class CableList extends Component
{
    use WithPagination;

    // Pagination and Sorting
    public $search = '';
    public $perPage = 10;
    public $sortField = 'label';
    public $sortDirection = 'asc';
    
    // Filters
    public $statusFilter = '';
    public $voltageFilter = '';
    
    // UI State
    public $isRefreshing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField' => ['except' => 'label'],
        'sortDirection' => ['except' => 'asc'],
        'statusFilter' => ['except' => ''],
        'voltageFilter' => ['except' => ''],
    ];

    public function mount()
    {
        // Initialize any required data
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function clearSearchAndApply()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function refreshData()
    {
        $this->isRefreshing = true;
        $this->resetPage();
        $this->isRefreshing = false;
    }

    public function resetFilters()
    {
        $this->reset(['search', 'statusFilter', 'voltageFilter']);
        $this->resetPage();
    }

    public function exportData()
    {
        return redirect()->route('report');
    }

    public function getCommonVoltageOptionsProperty()
    {
        return [11, 33, 132];
    }

    // Computed properties for the summary cards
    public function getTotalCablesProperty()
    {
        return Cable::count();
    }

    public function getActiveCablesProperty()
    {
        return Cable::where('status', 'Existing')->count();
    }

    public function getAbandonedCablesProperty()
    {
        return Cable::where('status', 'Abandoned')->count();
    }

    public function getInactiveCablesProperty()
    {
        return Cable::where('status', 'Inactive')->count();
    }

    public function render()
    {
        return view('livewire.cable-list', [
            'cables' => Cable::query()
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('label', 'like', '%'.$this->search.'%')
                            ->orWhere('circ_id', 'like', '%'.$this->search.'%')
                            ->orWhere('from_info', 'like', '%'.$this->search.'%')
                            ->orWhere('to_info', 'like', '%'.$this->search.'%')
                            ->orWhere('FromToName', 'like', '%'.$this->search.'%')
                            ->orWhere('SubstationLabel', 'like', '%'.$this->search.'%')
                            ->orWhere('FromLabel', 'like', '%'.$this->search.'%')
                            ->orWhere('ToLabel', 'like', '%'.$this->search.'%')
                            ->orWhere('op_area', 'like', '%'.$this->search.'%');
                    });
                })
                ->when($this->statusFilter, function ($query) {
                    $query->where('status', $this->statusFilter);
                })
                ->when($this->voltageFilter, function ($query) {
                    if ($this->voltageFilter === '_EMPTY_OR_NULL_') {
                        $query->where(function($q) {
                            $q->whereNull('voltage')
                              ->orWhere('voltage', '');
                        });
                    } else {
                        $voltage = $this->voltageFilter;
                        $query->whereRaw('voltage REGEXP ?', ['(^|\/|\s)'.$voltage.'(\/|\s?kV|$)']);
                    }
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
                
            'totalCables' => $this->totalCables,
            'activeCables' => $this->activeCables,
            'abandonedCables' => $this->abandonedCables,
            'inactiveCables' => $this->inactiveCables,
            'commonVoltageOptions' => $this->commonVoltageOptions,
        ]);
    }
}