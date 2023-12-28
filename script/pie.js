// Fetch Data
fetch('lib/getPieData.php')
  .then(response => response.json())
  .then(data => {
    const defaultValues = {
      'Accepted': 0,
      'Cancelled': 0,
    };

    const statusCounts = { ...defaultValues, ...data };
    const labels = Object.keys(statusCounts);
    const counts = Object.values(statusCounts);

    // Create Pie
    const ctx = document.getElementById('appointmentChart').getContext('2d');

    // Check if there is data
    if (counts.some(count => count > 0)) {
      const myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: counts,
            backgroundColor: ['#90F2AC', '#FF6099'], //'#FFF27D', pie color
          }],
        },
      });
    } else {
      const defaultPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['No Data'],
          datasets: [{
            data: [0.0001],
            backgroundColor: ['#DDD'],
          }],
        },
        options: {
            tooltips: {
              callbacks: {
                label: function (tooltipItem, data) {
                  var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                  return value.toFixed(1);
                },
              },
            },
          },
      });
    }
  })
  .catch(error => console.error('Error fetching data:', error));
