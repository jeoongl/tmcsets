

document.addEventListener('DOMContentLoaded', function () {
    fetch('fetch_expenses_last_seven_days.php')
        .then(response => response.json())
        .then(data => {
            const expenseChartLabels = data.dates;
            const expenseChartData = data.expenses;

            const ctx = document.getElementById('expenseChart').getContext('2d');
            const expenseChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: expenseChartLabels,
                    datasets: [{
                        label: 'Daily Expenses',
                        data: expenseChartData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});

document.addEventListener('DOMContentLoaded', function () {
fetch('fetch_gross_last_seven_days.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // Debug: Check the fetched data

        const grossChartLabels = data.dates;
        const grossChartData = data.gross_sales.map(value => Math.round(value)); // Round to nearest integer for money

        const ctx = document.getElementById('grossChart').getContext('2d');
        const grossChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: grossChartLabels,
                datasets: [{
                    label: 'Daily Gross Sales',
                    data: grossChartData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Adjust color if needed
                    borderColor: 'rgba(54, 162, 235, 1)', // Adjust color if needed
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return + value.toFixed(0); // Format as currency
                            }
                        }
                    }]
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));
});


document.addEventListener('DOMContentLoaded', function () {
        fetch('fetch_net_sales_last_seven_days.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log(data); // Debug: Check the fetched data

                const netChartLabels = data.dates;
                const netChartData = data.net_sales.map(value => parseFloat(value.toFixed(2))); // Ensure numeric values

                const ctx = document.getElementById('netChart').getContext('2d');
                const netChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: netChartLabels,
                        datasets: [{
                            label: 'Daily Net Sales',
                            data: netChartData,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)', // Adjust color if needed
                            borderColor: 'rgba(153, 102, 255, 1)', // Adjust color if needed
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function (value) {
                                        return + value.toFixed(0); // Format as currency
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });
    function updateDateTime() {
    const now = new Date();
    const date = now.toLocaleDateString();
    const time = now.toLocaleTimeString();

    document.getElementById('current-date').textContent = date;
    document.getElementById('current-time').textContent = time;
}

// Update the date and time immediately and then every second
updateDateTime();
setInterval(updateDateTime, 1000);