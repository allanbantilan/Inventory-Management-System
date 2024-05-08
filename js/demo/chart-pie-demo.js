// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Get data from the database using AJAX
$.ajax({
  url: 'includes/chart.php', // Replace 'your_php_script.php' with the path to your PHP script that fetches data from the database
  type: 'GET',
  dataType: 'json',
  success: function(response) {
    // Data retrieved successfully
    var labels = response.labels;
    var data = response.values;

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: data,
          backgroundColor: ['#dc3545', '#28a745', '#FFD700', '#6c757d'], // Green, Red, Yellow, Gray
          hoverBackgroundColor: ['#990000', '#004d00', '#996600', '#3d4c63'], // Darker shades for hover effect
          
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 60, // Adjust cutout percentage to make the hole smaller
      },
    });
  },
  error: function(xhr, status, error) {
    // Error handling
    console.error(xhr.responseText);
  }
});
