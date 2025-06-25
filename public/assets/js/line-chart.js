// Ensure the DOM is fully loaded before trying to access canvas elements
document.addEventListener('DOMContentLoaded', function() {
    // Data for the Bar Chart (Sales)
    var ctxBar = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctxBar, {
        type: "bar",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Sales",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                // Use an array of vibrant colors for each bar
                backgroundColor: [
                    '#81e6d9', // Teal
                    '#63b3ed', // Blue
                    '#f6ad55', // Orange
                    '#fc8181', // Red
                    '#9f7aea', // Purple
                    '#48bb78', // Green
                    '#ecc94b', // Yellow
                    '#ed8936', // Dark Orange
                    '#4299e1'  // Light Blue
                ],
                data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                maxBarThickness: 10 // Slightly increased bar thickness
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    enabled: true,
                    mode: "index",
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.7)', // Darker tooltip background
                    titleFontColor: '#e2e8f0', // Lighter tooltip title
                    bodyFontColor: '#e2e8f0', // Lighter tooltip body
                    padding: 10,
                    cornerRadius: 6,
                }
            },
            scales: {
                y: { // Changed from yAxes to y in Chart.js v3+
                    grid: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 500,
                        beginAtZero: true,
                        padding: 10, // Increased padding
                        font: {
                            size: 14,
                            family: "Inter",
                        },
                        color: "#cbd5e0", // Lighter font color for ticks
                    },
                },
                x: { // Changed from xAxes to x in Chart.js v3+
                    grid: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        display: true, // Display x-axis labels
                        padding: 15, // Increased padding
                        font: {
                            size: 14,
                            family: "Inter",
                        },
                        color: "#cbd5e0", // Lighter font color for ticks
                    },
                },
            },
        },
    });

    // Data for the Line Chart (Mobile Apps vs. Websites)
    var ctxLine = document.getElementById("chart-line").getContext("2d");

    // Gradient for "Mobile apps" - more vibrant orange to yellow
    var gradientStroke1 = ctxLine.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(251, 191, 36, 0.4)'); // Light orange
    gradientStroke1.addColorStop(0.5, 'rgba(246, 173, 85, 0.2)'); // Mid orange
    gradientStroke1.addColorStop(0, 'rgba(255, 214, 61, 0)'); // Fades to transparent yellow

    // Gradient for "Websites" - more vibrant pink to purple
    var gradientStroke2 = ctxLine.createLinearGradient(0, 230, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(237, 100, 166, 0.4)'); // Pink
    gradientStroke2.addColorStop(0.5, 'rgba(159, 122, 234, 0.2)'); // Purple
    gradientStroke2.addColorStop(0, 'rgba(99, 102, 241, 0)'); // Fades to transparent indigo

    new Chart(ctxLine, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 0,
                    borderColor: "#fbbf24", // Vibrant yellow-orange
                    backgroundColor: gradientStroke1,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    fill: true, // Ensure fill is enabled for gradients
                },
                {
                    label: "Websites",
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 0,
                    borderColor: "#ef4444", // Vibrant red
                    backgroundColor: gradientStroke2,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    fill: true, // Ensure fill is enabled for gradients
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    enabled: true,
                    mode: "index",
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFontColor: '#e2e8f0',
                    bodyFontColor: '#e2e8f0',
                    padding: 10,
                    cornerRadius: 6,
                }
            },
            scales: {
                y: { // Changed from yAxes to y in Chart.js v3+
                    grid: {
                        borderDash: [2],
                        borderDashOffset: [2],
                        color: 'rgba(226, 232, 240, 0.2)', // Lighter grid lines
                        zeroLineColor: 'rgba(226, 232, 240, 0.2)',
                        zeroLineWidth: 1,
                        zeroLineBorderDash: [2],
                        drawBorder: false,
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 500,
                        beginAtZero: true,
                        padding: 10,
                        font: {
                            size: 14,
                            family: "Inter",
                        },
                        color: "#cbd5e0", // Lighter font color for ticks
                    },
                },
                x: { // Changed from xAxes to x in Chart.js v3+
                    grid: {
                        zeroLineColor: 'rgba(0,0,0,0)',
                        display: false,
                    },
                    ticks: {
                        padding: 10,
                        font: {
                            size: 14,
                            family: "Inter",
                        },
                        color: "#cbd5e0", // Lighter font color for ticks
                    },
                },
            },
        },
    });
});
