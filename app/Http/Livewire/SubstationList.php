<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Substation;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB; // Import DB facade

class SubstationList extends Component
{
    use WithPagination;

    // Pagination and Sorting
    public $search = '';
    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    
    // Filters
    public $statusFilter = '';
    public $voltageFilter = '';
    
    // UI State
    public $isRefreshing = false;

    // Chart Data properties
    public $ppuChartData = [];
    public $ssuChartData = [];
    public $pmuChartData = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'statusFilter' => ['except' => ''],
        'voltageFilter' => ['except' => ''],
    ];

    public function mount()
    {
        $this->loadChartData(); // Load chart data on mount
    }

    // New method to load chart data
    public function loadChartData()
    {
        $this->ppuChartData = $this->getChartDataForCategory('PPU');
        $this->ssuChartData = $this->getChartDataForCategory('SSU');
        $this->pmuChartData = $this->getChartDataForCategory('PMU');
    }

    // Helper method to get chart data for a specific category
    private function getChartDataForCategory($category)
    {
        $data = Substation::select('status', DB::raw('count(*) as count'))
            ->where('category', $category)
            ->groupBy('status')
            ->orderBy('status') // Order by status for consistent chart rendering
            ->get()
            ->keyBy('status')
            ->toArray();

        // Ensure all possible statuses are present, even if count is 0
        $statuses = ['Existing', 'Inactive', 'Abandoned']; // Define all possible statuses
        $chartData = [];
        foreach ($statuses as $status) {
            $chartData[$status] = $data[$status]['count'] ?? 0;
        }

        return $chartData;
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
        $this->loadChartData(); // Reload chart data on filter reset
    }

    public function applyFilters()
    {
        $this->resetPage();
        $this->loadChartData(); // Reload chart data on filter apply
    }

    public function refreshData()
    {
        $this->isRefreshing = true;
        $this->resetPage();
        $this->loadChartData(); // Reload chart data on refresh
        $this->isRefreshing = false;
    }

    public function resetFilters()
    {
        $this->reset(['search', 'statusFilter', 'voltageFilter']);
        $this->resetPage();
        $this->loadChartData(); // Reload chart data on filter reset
    }

    public function exportData()
    {
        return redirect()->route('report');
    }

    public function getCommonVoltageOptionsProperty()
    {
        return ['132/11', '132/33', '132/33/11', '33', '33/0.415', '33/11', '33/11KV'];
    }

    public function getTotalSubstationsProperty()
    {
        return Substation::count();
    }

    public function getActiveSubstationsProperty()
    {
        return Substation::where('status', 'Existing')->count();
    }

    public function getAbandonedSubstationsProperty()
    {
        return Substation::where('status', 'Abandoned')->count();
    }

    public function getInactiveSubstationsProperty()
    {
        return Substation::where('status', 'Inactive')->count();
    }

    public function render()
    {
        return view('livewire.substation-list', [
            'substations' => Substation::query()
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('name', 'like', '%'.$this->search.'%')
                            ->orWhere('substation_id', 'like', '%'.$this->search.'%')
                            ->orWhere('owner_type', 'like', '%'.$this->search.'%')
                            ->orWhere('owner_name', 'like', '%'.$this->search.'%')
                            ->orWhere('design', 'like', '%'.$this->search.'%')
                            ->orWhere('label', 'like', '%'.$this->search.'%')
                            ->orWhere('voltage', 'like', '%'.$this->search.'%')
                            ->orWhere('category', 'like', '%'.$this->search.'%')
                            ->orWhere('status_act', 'like', '%'.$this->search.'%')                            
                            ->orWhere('functional_location', 'like', '%'.$this->search.'%')
                            ->orWhere('operational_area', 'like', '%'.$this->search.'%')
                            ->orWhere('status', 'like', '%'.$this->search.'%');
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
                        $query->where('voltage', $this->voltageFilter);
                    }
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
                
            'totalSubstations' => $this->totalSubstations,
            'activeSubstations' => $this->activeSubstations,
            'abandonedSubstations' => $this->abandonedSubstations,
            'inactiveSubstations' => $this->inactiveSubstations,
            'commonVoltageOptions' => $this->commonVoltageOptions,
            // Pass chart data to the view
            'ppuChartData' => $this->ppuChartData,
            'ssuChartData' => $this->ssuChartData,
            'pmuChartData' => $this->pmuChartData,
        ]);
    }
}