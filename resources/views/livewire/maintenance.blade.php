<!-- maintenance.blade.php -->
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
            <div class="col-xl col-sm-12 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="mb-0">Breakdown vs Pending Status</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart-container" style="position: relative; height:400px; width:100%">
                            <canvas id="breakdownStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-sm-12 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="mb-0">Station Breakdown Frequency</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart-container" style="position: relative; height:400px; width:100%">
                            <canvas id="stationBreakdownChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- New card for Combined Breakdown and Rectified by Station chart --}}
        <div class="row mt-4">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="mb-0">Breakdowns and Rectifications by Station</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart-container" style="position: relative; height:400px; width:100%">
                            <canvas id="combinedStationBreakdownChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- New card for Breakdown Trend by Station chart --}}
        <div class="row mt-4">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="mb-0">Breakdown Trend by Station Over Time</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart-container" style="position: relative; height:400px; width:100%">
                            <canvas id="breakdownTrendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- If you had a Tableau embed, it would go here --}}
        <div class="row mt-4">
          <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class='tableauPlaceholder' id='viz1750050533998' style='position: relative'><noscript><a href='#'><img alt='Story 1 ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;NZ&#47;NZ9DYH67G&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='path' value='shared&#47;NZ9DYH67G' /> <param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;NZ&#47;NZ9DYH67G&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1750050533998');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';
                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
                </div>
                </div>
              </div>
            </div>
        </div>

        
    </div>
</main>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', function () {
        // --- Chart 1: Breakdown vs Pending Status ---
        const rawChartData = @json($chartData);
        console.log('Raw Chart Data (Breakdown vs Pending):', rawChartData);

        const statuses = rawChartData.map(item => item.status);
        const quantities = rawChartData.map(item => item.quantity);

        const breakdownColors = [
            'rgba(255, 99, 132, 0.8)', // Color for Total Breakdowns
            'rgba(255, 206, 86, 0.8)'  // Color for Pending Breakdowns
        ];
        const breakdownBorderColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(255, 206, 86, 1)'
        ];

        const ctxBreakdown = document.getElementById('breakdownStatusChart').getContext('2d');

        new Chart(ctxBreakdown, {
            type: 'bar',
            data: {
                labels: statuses,
                datasets: [{
                    label: 'Quantity',
                    data: quantities,
                    backgroundColor: breakdownColors,
                    borderColor: breakdownBorderColors,
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Breakdown vs Pending Status'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Quantity'
                        },
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Status'
                        },
                    }
                }
            }
        });

        // --- Chart 2: Station Breakdown Frequency ---
        const rawStationBreakdownChartData = @json($stationBreakdownChartData);
        console.log('Raw Chart Data (Station Breakdown Frequency):', rawStationBreakdownChartData);

        const stations = rawStationBreakdownChartData.map(item => item.station);
        const frequencies = rawStationBreakdownChartData.map(item => item.frequency);

        // Define a consistent color for the bars of the station breakdown chart
        const stationBackgroundColor = 'rgba(75, 192, 192, 0.8)';
        const stationBorderColor = 'rgba(75, 192, 192, 1)';

        const ctxStationBreakdown = document.getElementById('stationBreakdownChart').getContext('2d');

        new Chart(ctxStationBreakdown, {
            type: 'bar', // Bar chart type
            data: {
                labels: stations, // X-axis labels are station names
                datasets: [{
                    label: 'Number of Breakdowns', // Label for the dataset
                    data: frequencies, // Y-axis data is breakdown frequency
                    backgroundColor: stationBackgroundColor,
                    borderColor: stationBorderColor,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Station Breakdown Frequency' // Chart title
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Station' // X-axis title
                        },
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Number of Breakdowns' // Y-axis title
                        },
                        beginAtZero: true,
                        ticks: {
                            precision: 0 // Ensure whole numbers for frequency
                        }
                    }
                }
            }
        });

        // --- Chart 3: Combined Breakdown and Rectified by Station ---
        const rawCombinedStationChartData = @json($combinedStationChartData);
        console.log('Raw Chart Data (Combined Breakdown and Rectified by Station):', rawCombinedStationChartData);

        const ctxCombinedStation = document.getElementById('combinedStationBreakdownChart').getContext('2d');

        new Chart(ctxCombinedStation, {
            type: 'bar', // Bar chart type
            data: {
                labels: rawCombinedStationChartData.labels, // Stations as labels
                datasets: rawCombinedStationChartData.datasets // Two datasets: Total and Rectified
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Breakdowns and Rectifications by Station' // Chart title
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Station' // X-axis title
                        },
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Quantity' // Y-axis title
                        },
                        beginAtZero: true,
                        ticks: {
                            precision: 0 // Ensure whole numbers
                        }
                    }
                }
            }
        });

        // --- Chart 4: Breakdown Trend by Station Over Time ---
        const rawBreakdownTrendChartData = @json($breakdownTrendChartData);
        console.log('Raw Chart Data (Breakdown Trend by Station):', rawBreakdownTrendChartData);

        const ctxBreakdownTrend = document.getElementById('breakdownTrendChart').getContext('2d');

        new Chart(ctxBreakdownTrend, {
            type: 'line', // Line chart type for trend
            data: {
                labels: rawBreakdownTrendChartData.labels, // Dates as X-axis labels
                datasets: rawBreakdownTrendChartData.datasets // Multiple datasets, one for each station
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Breakdown Trend by Station Over Time' // Chart title
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Month-Year' // X-axis title for dates
                        },
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Number of Breakdowns' // Y-axis title
                        },
                        beginAtZero: true,
                        ticks: {
                            precision: 0 // Ensure whole numbers
                        }
                    }
                }
            }
        });
    });
</script>
@endpush

