<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BreakdownRecord; // Import the BreakdownRecord model
use Livewire\WithPagination; // Import WithPagination trait
use Carbon\Carbon; // Import Carbon for date handling if needed for display/sorting

class MaintenanceList extends Component
{
    use WithPagination;

    // Properties for search, sorting, and pagination
    public $search = '';
    public $perPage = 10;
    public $sortField = 'tripping_date_time'; // Default sort field
    public $sortDirection = 'desc'; // Default sort direction

    // Query string parameters to keep state in the URL
    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField' => ['except' => 'tripping_date_time'],
        'sortDirection' => ['except' => 'desc'],
    ];

    // Method to calculate total breakdown records
    public function getTotalBreakdownsProperty()
    {
        return BreakdownRecord::count();
    }

    // Method to calculate total rectified breakdown records
    public function getTotalRectifiedProperty()
    {
        return BreakdownRecord::whereNotNull('restoration_date_time')->count();
    }

    // Method to calculate total pending breakdown records
    public function getTotalPendingProperty()
    {
        return BreakdownRecord::whereNull('restoration_date_time')->count();
    }

    // Computed property to fetch breakdown records with applied search, sorting, and pagination
    public function getBreakdownRecordsProperty()
    {
        $query = BreakdownRecord::query();

        // Apply search filter to multiple relevant fields
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('tripping_document_id', 'like', '%' . $this->search . '%')
                    ->orWhere('tripping_no', 'like', '%' . $this->search . '%')
                    ->orWhere('source', 'like', '%' . $this->search . '%')
                    ->orWhere('ap_name', 'like', '%' . $this->search . '%')
                    ->orWhere('tripping_point', 'like', '%' . $this->search . '%')
                    ->orWhere('state', 'like', '%' . $this->search . '%')
                    ->orWhere('station', 'like', '%' . $this->search . '%')
                    ->orWhere('failure_mode', 'like', '%' . $this->search . '%')
                    ->orWhere('description_damage_area', 'like', '%' . $this->search . '%')
                    ->orWhere('substation_name', 'like', '%' . $this->search . '%');
            });
        }

        // Apply sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        // Paginate the results. 'breakdownPage' is a unique name for this paginator.
        return $query->paginate($this->perPage, ['*'], 'breakdownPage');
    }

    // Reset pagination when the search term changes
    public function updatingSearch()
    {
        $this->resetPage('breakdownPage');
    }

    // Reset pagination when the 'per page' value changes
    public function updatingPerPage()
    {
        $this->resetPage('breakdownPage');
    }

    // Method to handle column sorting
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            // If already sorting by this field, toggle direction
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Otherwise, set new sort field and default to ascending
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage('breakdownPage'); // Reset pagination on sort change
    }

    // Method to apply filters (mainly triggers a re-render and query update)
    public function applyFilters()
    {
        $this->resetPage('breakdownPage'); // Reset pagination to the first page when applying filters
    }

    // Method to reset all filters and pagination
    public function resetFilters()
    {
        $this->reset(['search', 'perPage']); // Reset search term and perPage
        $this->resetPage('breakdownPage'); // Reset pagination to the first page
        $this->sortField = 'tripping_date_time'; // Reset sort field
        $this->sortDirection = 'desc'; // Reset sort direction
    }

    // Render the Livewire component view
    public function render()
    {
        return view('livewire.maintenance-list', [
            'breakdownRecords' => $this->getBreakdownRecordsProperty(),
            'totalBreakdowns' => $this->getTotalBreakdownsProperty(),
            'totalRectified' => $this->getTotalRectifiedProperty(),
            'totalPending' => $this->getTotalPendingProperty(),
        ]);
    }
}
