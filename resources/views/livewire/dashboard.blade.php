<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
  <div class="container-fluid py-4">
    <div class="row">
        {{-- Total Substations Card --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Substations</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $totalSubstations }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-bolt text-lg opacity-10" aria-hidden="true"></i> {{-- Changed icon to bolt --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Existing Substations Card (formerly Active) --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Existing Substations</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $existingSubstations }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md"> {{-- Changed to success gradient --}}
                                <i class="fas fa-check-circle text-lg opacity-10" aria-hidden="true"></i> {{-- Changed icon to check-circle --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Inactive Substations Card --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Inactive Substations</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $inactiveSubstations }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md"> {{-- Changed to secondary gradient --}}
                                <i class="fas fa-times-circle text-lg opacity-10" aria-hidden="true"></i> {{-- Changed icon to times-circle --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Cables Card (Placeholder) --}}
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Cables</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $totalCables }} {{-- Dynamic variable --}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md"> {{-- Changed to info gradient, cable icon --}}
                                <i class="fas fa-network-wired text-lg opacity-10" aria-hidden="true"></i> {{-- Changed icon to network-wired (or fa-cable) --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Breakdown Card (Placeholder) --}}
        <div class="col-xl-6 col-sm-6 mt-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Breakdown</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $totalBreakdown }} {{-- Dynamic variable --}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md"> {{-- Changed to warning gradient, wrench icon --}}
                                <i class="fas fa-wrench text-lg opacity-10" aria-hidden="true"></i> {{-- Changed icon to wrench (or fa-exclamation-circle for issues) --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mt-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Breakdown Rectified</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $totalRectify }} {{-- Dynamic variable --}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md"> {{-- Changed to warning gradient, wrench icon --}}
                                <i class="fas fa-wrench text-lg opacity-10" aria-hidden="true"></i> {{-- Changed icon to wrench (or fa-exclamation-circle for issues) --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-4 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Substations Status Distribution</h6>
                    </div>
                </div>
                <div class="card-body p-3">
                    {{-- Canvas for the Bar Chart --}}
                    <div class="chart">
                        <canvas id="substationBarChart" class="chart-canvas" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
        {{-- New card for Operational Area Pie Chart --}}
        <div class="col-lg mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Substations by Operational Area</h6>
                    </div>
                </div>
                <div class="card-body p-3">
                    {{-- Canvas for the Pie Chart --}}
                    <div class="chart">
                        <canvas id="operationalAreaPieChart" class="chart-canvas" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- The original table will now occupy the full width below the charts --}}
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Substations by State</h6>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer" wire:click="sortBy('name')">
                                        <div class="d-flex align-items-center">
                                            <span>Name</span>
                                            @if($sortField === 'name')
                                                <span class="ms-1">
                                                    @if($sortDirection === 'asc')
                                                        <i class="fas fa-sort-up"></i>
                                                    @else
                                                        <i class="fas fa-sort-down"></i>
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 cursor-pointer" wire:click="sortBy('state')">
                                        <div class="d-flex align-items-center">
                                            <span>State</span>
                                            @if($sortField === 'state')
                                                <span class="ms-1">
                                                    @if($sortDirection === 'asc')
                                                        <i class="fas fa-sort-up"></i>
                                                    @else
                                                        <i class="fas fa-sort-down"></i>
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Voltage (kV)</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($substations as $substation)
                                <tr class="cursor-pointer" onclick="window.location='{{ route('substation.show', $substation) }}'">
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $substation->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $substation->label }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $substation->state ?? 'N/A' }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $substation->voltage ?? 'N/A' }}</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @php
                                            $statusConfig = [
                                                'Existing' => ['color' => 'success', 'icon' => 'check-circle'],
                                                'Inactive' => ['color' => 'secondary', 'icon' => 'times-circle'],
                                                'Abandoned' => ['color' => 'warning', 'icon' => 'tools'],
                                            ];
                                            $status = $substation->status ?? 'Unknown';
                                            $config = $statusConfig[$status] ?? ['color' => 'dark', 'icon' => 'question-circle'];
                                        @endphp
                                        <span class="badge bg-gradient-{{ $config['color'] }} d-inline-flex align-items-center">
                                            <i class="fas fa-{{ $config['icon'] }} me-1"></i>
                                            {{ $status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <p class="text-muted">No substations found</p>
                                        @if($search)
                                            <button wire:click="clearSearch" class="btn btn-sm btn-outline-primary">
                                                Clear search
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($substations->hasPages())
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="text-sm text-muted">
                            Showing {{ $substations->firstItem() }} to {{ $substations->lastItem() }} of {{ $substations->total() }} entries
                        </div>
                        <div>
                            {{ $substations->links('livewire::bootstrap') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
  </div>
</main>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        // Data for the bar chart, passed from the Livewire component
        const substationStatusLabels = @json($substationStatusLabels);
        const substationStatusData = @json($substationStatusData);
        const substationStatusColors = @json($substationStatusColors);

        // Data for the operational area pie chart, passed from the Livewire component
        const operationalAreaLabels = @json($operationalAreaLabels);
        const operationalAreaData = @json($operationalAreaData);
        const operationalAreaColors = @json($operationalAreaColors);


        // Get the canvas element for the Bar Chart
        const barCtx = document.getElementById('substationBarChart').getContext('2d');

        // Create the bar chart
        new Chart(barCtx, {
            type: 'bar', // Chart type changed to 'bar'
            data: {
                labels: substationStatusLabels, // Labels for the X-axis (status)
                datasets: [{
                    label: 'Number of Substations', // Label for the dataset
                    data: substationStatusData, // Data values for the bars (quantity)
                    backgroundColor: substationStatusColors, // Colors for each bar
                    borderColor: substationStatusColors.map(color => color + 'B3'), // Slightly transparent border for bars
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Chart will be responsive to container size
                maintainAspectRatio: false, // Allows flexible height based on container
                plugins: {
                    legend: {
                        display: true, // Display legend to show what the bars represent
                        position: 'top', // Position the legend at the top
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true, // Display chart title
                        text: 'Substation Status Distribution', // Title text
                        font: {
                            size: 16
                        }
                    },
                    datalabels: { // Datalabels plugin configuration for the bar chart
                        color: '#444', // Dark color for contrast on bars
                        anchor: 'end', // Position label at the end of the bar
                        align: 'top', // Align label to the top of the bar
                        offset: 4, // Small offset from the bar
                        font: {
                            weight: 'bold',
                            size: 12
                        },
                        formatter: (value, ctx) => {
                            return value; // Simply return the value (quantity)
                        }
                    }
                },
                scales: {
                    x: { // X-axis configuration
                        title: {
                            display: true,
                            text: 'Status', // X-axis label
                            font: {
                                size: 14
                            }
                        },
                        grid: {
                            display: false // Hide vertical grid lines for cleaner look
                        }
                    },
                    y: { // Y-axis configuration
                        title: {
                            display: true,
                            text: 'Quantity', // Y-axis label
                            font: {
                                size: 14
                            }
                        },
                        beginAtZero: true, // Start Y-axis at 0
                        ticks: {
                            precision: 0 // Ensure whole numbers for quantities
                        }
                    }
                }
            }
        });

        // Get the canvas element for the Operational Area Pie Chart
        const pieCtx = document.getElementById('operationalAreaPieChart').getContext('2d');

        // Create the pie chart for Operational Area
        new Chart(pieCtx, {
            type: 'pie', // Chart type
            data: {
                labels: operationalAreaLabels, // Labels for each segment (operational areas)
                datasets: [{
                    data: operationalAreaData, // Data values for each segment (quantities)
                    backgroundColor: operationalAreaColors, // Colors for each segment
                    hoverOffset: 4 // Offset for hovered segments
                }]
            },
            options: {
                responsive: true, // Chart will be responsive to container size
                maintainAspectRatio: false, // Allows flexible height based on container
                plugins: {
                    legend: {
                        position: 'right', // Legend on the right
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    datalabels: { // Datalabels plugin configuration
                        color: '#fff', // White color for the labels
                        font: {
                            weight: 'bold',
                            size: 12
                        },
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed(1) + '%';
                            
                            // Combine label and percentage
                            return ctx.chart.data.labels[ctx.dataIndex] + '\n' + percentage;
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
