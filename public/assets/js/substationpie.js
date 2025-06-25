document.addEventListener('DOMContentLoaded', function() {
    // Check if elements exist
    const chartCanvas = document.getElementById('statusChart');
    const legendContainer = document.getElementById('chartLegend');
    
    if (!chartCanvas || !legendContainer) {
        console.error('Required elements not found in DOM');
        return;
    }

    // These variables will be replaced with data from your database
    const statusData = {
        operational: 45,
        maintenance: 12,
        plannedOutage: 8,
        forcedOutage: 5,
        construction: 15
    };

    const totalSubstations = Object.values(statusData).reduce((a, b) => a + b, 0);

    try {
        const ctx = chartCanvas.getContext('2d');
        const statusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    `Operational (${statusData.operational})`,
                    `Maintenance (${statusData.maintenance})`,
                    `Planned Outage (${statusData.plannedOutage})`,
                    `Forced Outage (${statusData.forcedOutage})`,
                    `Construction (${statusData.construction})`
                ],
                datasets: [{
                    data: Object.values(statusData),
                    backgroundColor: [
                        '#4CAF50', '#FFC107', '#2196F3', '#F44336', '#9E9E9E'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                const percentage = Math.round((value / totalSubstations) * 100);
                                return `${context.label}: ${value} (${percentage}%)`;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: `Substation Status Distribution (Total: ${totalSubstations})`
                    }
                }
            }
        });

        legendContainer.innerHTML = `Total Substations: <strong>${totalSubstations}</strong>`;
        
        // Example of how to update the chart later with real data
        window.updateChartData = function(newData) {
            statusChart.data.datasets[0].data = Object.values(newData);
            statusChart.data.labels = Object.keys(newData).map(key => 
                `${key} (${newData[key]})`
            );
            const newTotal = Object.values(newData).reduce((a, b) => a + b, 0);
            statusChart.options.plugins.title.text = `Substation Status Distribution (Total: ${newTotal})`;
            legendContainer.innerHTML = `Total Substations: <strong>${newTotal}</strong>`;
            statusChart.update();
        };

    } catch (error) {
        console.error('Chart initialization failed:', error);
    }
});