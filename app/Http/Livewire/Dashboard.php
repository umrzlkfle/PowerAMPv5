<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Substation; // Import the Substation model
use Illuminate\Support\Facades\DB; // Import DB facade for raw queries
use Livewire\Attributes\On; // Import the On attribute for Livewire 3+ listeners
use App\Models\Cable; // Add this at the top with other imports
use Livewire\WithPagination;
use App\Models\BreakdownRecord; // Make sure BreakdownRecord is imported

class Dashboard extends Component
{

    use WithPagination;
    // Public properties to hold data for Chart.js
    public $substationStatusLabels = [];
    public $substationStatusData = [];
    public $substationStatusColors = [];

    // New public properties for Operational Area Chart
    public $operationalAreaLabels = [];
    public $operationalAreaData = [];
    public $operationalAreaColors = [];

    // --- (Your existing computed properties for totals) ---

    public function getTotalSubstationsProperty()
    {
        return Substation::count();
    }

    public function getExistingSubstationsProperty()
    {
        return Substation::where('status', 'Existing')->count();
    }

    public function getInactiveSubstationsProperty()
    {
        return Substation::where('status', 'Inactive')->count();
    }

    public function getAbandonedSubstationsProperty()
    {
        return Substation::where('status', 'Abandoned')->count();
    }

    public function getTotalCablesProperty()
    {
        return Cable::count();
    }


    // Update the getTotalBreakdownProperty function
    public function getTotalBreakdownProperty()
    {
        // Use the BreakdownRecord model to count all records
        return BreakdownRecord::count();
    }
    
    public function getTotalRectifyProperty()
    {
        // Use the BreakdownRecord model to count all records
        return BreakdownRecord::whereNotNull('restoration_date_time')->count();
    }

    // --- (Existing: Data preparation for Chart.js) ---
    public function mount()
    {
        $this->prepareSubstationChartData();
        $this->prepareOperationalAreaChartData(); // Call the new method here
    }

    public function prepareSubstationChartData()
    {
        $statusCounts = Substation::select('status', DB::raw('count(*) as total'))
                                   ->groupBy('status')
                                   ->get();

        $labels = [];
        $data = [];
        $colors = [];

        // Define a consistent color map for statuses
        $colorMap = [
            'Existing'   => '#4CAF50', // Green
            'Inactive'   => '#FFC107', // Amber/Yellow
            'Abandoned'  => '#F44336', // Red
            // Add more statuses and their colors if you have them in your database
            'Under Maintenance' => '#007bff', // Blue
            'Planned' => '#17a2b8', // Teal
        ];

        foreach ($statusCounts as $statusCount) {
            $labels[] = $statusCount->status;
            $data[] = $statusCount->total;
            // Assign color from map, or a default if not found
            $colors[] = $colorMap[$statusCount->status] ?? '#6c757d'; // Default grey
        }

        $this->substationStatusLabels = $labels;
        $this->substationStatusData = $data;
        $this->substationStatusColors = $colors;
    }

    // New method to prepare data for Operational Area Chart
    public function prepareOperationalAreaChartData()
    {
        $areaCounts = Substation::select('operational_area', DB::raw('count(*) as total'))
                                ->whereNotNull('operational_area') // Exclude null areas if any
                                ->groupBy('operational_area')
                                ->get();

        $labels = [];
        $data = [];
        $colors = [];

        // Define a set of colors for operational areas.
        // You might want to expand this or generate dynamically if you have many areas.
        $areaColorPalette = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
            '#E7E9ED', '#8D6E63', '#B39DDB', '#DCE775', '#A1887F', '#EF5350'
        ];
        $colorIndex = 0;

        foreach ($areaCounts as $areaCount) {
            $labels[] = $areaCount->operational_area;
            $data[] = $areaCount->total;
            $colors[] = $areaColorPalette[$colorIndex % count($areaColorPalette)];
            $colorIndex++;
        }

        $this->operationalAreaLabels = $labels;
        $this->operationalAreaData = $data;
        $this->operationalAreaColors = $colors;
    }


    public $search = '';
    public $sortField = 'operational_area'; // Changed to operational_area
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'operational_area'], // Changed to operational_area
        'sortDirection' => ['except' => 'asc'],
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'totalSubstations' => $this->totalSubstations,
            'existingSubstations' => $this->existingSubstations,
            'inactiveSubstations' => $this->inactiveSubstations,
            'abandonedSubstations' => $this->abandonedSubstations,
            'totalCables' => $this->totalCables,
            'totalBreakdown' => $this->totalBreakdown,
            'totalRectify' => $this->totalRectify,
            'substations' => Substation::query()
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('name', 'like', '%'.$this->search.'%')
                          ->orWhere('label', 'like', '%'.$this->search.'%')
                          ->orWhere('operational_area', 'like', '%'.$this->search.'%'); // Changed to operational_area
                    });
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}