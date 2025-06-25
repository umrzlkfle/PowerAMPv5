<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Substation; // Import Substation model
use App\Models\Cable;      // Import Cable model
use App\Models\BreakdownRecord; // Import BreakdownRecord model
use Carbon\Carbon; // Import Carbon for date handling

class Maintenance extends Component
{
    public $chartData = []; // Property to hold data for the Breakdown vs Pending chart
    public $stationBreakdownChartData = []; // Property to hold data for the Station Breakdown Frequency chart
    public $combinedStationChartData = []; // Property for combined breakdown/rectified chart by station
    public $breakdownTrendChartData = []; // New property for the breakdown trend line chart

    public function mount()
    {
        $this->loadChartData(); // Load data for Breakdown vs Pending chart
        $this->loadStationBreakdownChartData(); // Load data for Station Breakdown Frequency chart
        $this->loadCombinedStationChartData(); // Load data for the combined breakdown/rectified chart
        $this->loadBreakdownTrendChartData(); // Load data for the new breakdown trend line chart
    }

    // Function to calculate total substations
    public function getTotalSubstationsProperty()
    {
        return Substation::count();
    }

    // Function to calculate existing substations
    public function getExistingSubstationsProperty()
    {
        return Substation::where('status', 'Existing')->count();
    }

    // Function to calculate inactive substations
    public function getInactiveSubstationsProperty()
    {
        return Substation::where('status', 'Inactive')->count();
    }

    // Function to calculate abandoned substations
    public function getAbandonedSubstationsProperty()
    {
        return Substation::where('status', 'Abandoned')->count();
    }

    // Function to calculate total cables
    public function getTotalCablesProperty()
    {
        return Cable::count();
    }

    // Function to get total breakdown records
    public function getTotalBreakdownProperty()
    {
        return BreakdownRecord::count();
    }

    // Function to get total rectified breakdown records
    public function getTotalRectifyProperty()
    {
        return BreakdownRecord::whereNotNull('restoration_date_time')->count();
    }

    // Function to load and process data specifically for the Breakdown vs Pending chart
    public function loadChartData()
    {
        $totalBreakdowns = $this->getTotalBreakdownProperty();
        $totalRectified = $this->getTotalRectifyProperty();

        $pendingBreakdowns = $totalBreakdowns - $totalRectified;

        // Prepare data in a flat format suitable for JavaScript processing
        $this->chartData = [
            [
                'status' => 'Total Breakdowns',
                'quantity' => $totalBreakdowns
            ],
            [
                'status' => 'Pending Breakdowns',
                'quantity' => $pendingBreakdowns
            ]
        ];
    }

    // Function to load and process data for the Station Breakdown Frequency chart
    public function loadStationBreakdownChartData()
    {
        // Fetch all breakdown records, focusing on the 'station' column
        $records = BreakdownRecord::select('station')->get();

        $stationFrequencies = [];

        // Group and count total breakdowns per station
        foreach ($records as $record) {
            $station = $record->station;

            if (!isset($stationFrequencies[$station])) {
                $stationFrequencies[$station] = 0;
            }
            $stationFrequencies[$station]++; // Increment frequency for this station
        }

        $formattedChartData = [];
        // Prepare data in a flat format suitable for JavaScript processing
        foreach ($stationFrequencies as $station => $frequency) {
            $formattedChartData[] = [
                'station' => $station, // The station name for the X-axis
                'frequency' => $frequency // The total count of breakdowns for this station (Y-axis)
            ];
        }

        $this->stationBreakdownChartData = $formattedChartData;
    }

    // Function to load and process data for the combined Breakdown and Rectified chart by station
    public function loadCombinedStationChartData()
    {
        // Fetch all breakdown records
        $records = BreakdownRecord::all();

        $stationData = [];

        foreach ($records as $record) {
            $station = $record->station;

            if (!isset($stationData[$station])) {
                $stationData[$station] = [
                    'total_breakdowns' => 0,
                    'total_rectified' => 0
                ];
            }

            $stationData[$station]['total_breakdowns']++;

            // Check if restoration_date_time is not null, meaning it's rectified
            if ($record->restoration_date_time !== null) {
                $stationData[$station]['total_rectified']++;
            }
        }

        // Prepare data in a format suitable for Chart.js grouped bar chart
        $stations = array_keys($stationData);
        $totalBreakdowns = array_map(function($data) {
            return $data['total_breakdowns'];
        }, $stationData);
        $totalRectified = array_map(function($data) {
            return $data['total_rectified'];
        }, $stationData);

        $this->combinedStationChartData = [
            'labels' => $stations,
            'datasets' => [
                [
                    'label' => 'Total Breakdowns',
                    'data' => $totalBreakdowns,
                    'backgroundColor' => 'rgba(255, 159, 64, 0.8)', // Orange color
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Rectified Breakdowns',
                    'data' => $totalRectified,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.8)', // Blue color
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];
    }

    // New function to load and process data for the breakdown trend line chart
    public function loadBreakdownTrendChartData()
    {
        // Fetch breakdown records with tripping date and station, filtering out null dates
        $records = BreakdownRecord::select('tripping_date_time', 'station')
                                ->whereNotNull('tripping_date_time')
                                ->get();

        $allDates = collect();
        $stationBreakdowns = collect();

        foreach ($records as $record) {
            // Format date to YYYY-MM for consistent grouping
            $date = Carbon::parse($record->tripping_date_time)->format('Y-m');
            $station = $record->station;

            // Collect all unique dates
            $allDates->push($date);

            // Initialize station data if not exists
            if (!$stationBreakdowns->has($station)) {
                $stationBreakdowns->put($station, collect());
            }

            // Increment breakdown count for specific station and date
            $currentCount = $stationBreakdowns->get($station)->get($date, 0);
            $stationBreakdowns->get($station)->put($date, $currentCount + 1);
        }

        // Get unique and sorted dates
        $uniqueDates = $allDates->unique()->sort()->values()->toArray();

        $datasets = [];
        // Define a set of colors for the trend lines
        $colors = [
            'rgba(255, 99, 132, 1)', // Red
            'rgba(54, 162, 235, 1)', // Blue
            'rgba(255, 206, 86, 1)', // Yellow
            'rgba(75, 192, 192, 1)', // Green
            'rgba(153, 102, 255, 1)',// Purple
            'rgba(255, 159, 64, 1)', // Orange
            'rgba(199, 199, 199, 1)',// Grey
        ];
        $colorIndex = 0;

        foreach ($stationBreakdowns as $station => $dateCounts) {
            $dataPoints = [];
            foreach ($uniqueDates as $date) {
                // Get count for the current station and date, or 0 if no breakdowns
                $dataPoints[] = $dateCounts->get($date, 0);
            }

            $datasets[] = [
                'label' => $station,
                'data' => $dataPoints,
                'borderColor' => $colors[$colorIndex % count($colors)], // Assign color cyclically
                'backgroundColor' => $colors[$colorIndex % count($colors)],
                'fill' => false, // No fill under the line
                'tension' => 0.1 // Smooth line
            ];
            $colorIndex++;
        }

        $this->breakdownTrendChartData = [
            'labels' => $uniqueDates,
            'datasets' => $datasets
        ];
    }


    public function render()
    {
        return view('livewire.maintenance', [
            'chartData' => $this->chartData,
            'stationBreakdownChartData' => $this->stationBreakdownChartData,
            'combinedStationChartData' => $this->combinedStationChartData,
            'breakdownTrendChartData' => $this->breakdownTrendChartData, // Pass data for the new trend chart
        
            'totalSubstations' => $this->totalSubstations,
            'existingSubstations' => $this->existingSubstations,
            'inactiveSubstations' => $this->inactiveSubstations,
            'abandonedSubstations' => $this->abandonedSubstations,
            'totalCables' => $this->totalCables,
            'totalBreakdown' => $this->totalBreakdown,
            'totalRectify' => $this->totalRectify,
            
        ]);
    }
}

