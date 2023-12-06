 // Mock Data
 var data = {
    labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
    datasets: [
        {
            label: 'Cancelled',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            data: [1, 4, 7, 3, 5, 2, 9]
        },
        {
            label: 'Accepted',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            data: [3, 6, 2, 4, 9, 5, 8]
        },
        {
            label: 'Request',
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1,
            data: [5, 8, 3, 2, 7, 4, 6]
        }
    ]
};

// Create Bar Chart
var ctx = document.getElementById('myBarChart').getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        scales: {
            x: {
                stacked: true,
                ticks: {
                    color: '#531A62' // text color
                }
            },
            y: {
                stacked: true,
                ticks: {
                    color: '#531A62' // text color
                }
            }
        }
    }
});