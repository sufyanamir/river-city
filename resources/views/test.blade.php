@include('layouts.header')
<div class="">
  <canvas id="myDoughnutChart" width="400" height="400"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Get a reference to the canvas element
  var ctx = document.getElementById('myDoughnutChart').getContext('2d');

  // Define your data
  var data = {
    labels: ['#2ED47A', '#FFB946', '#F7685B'],
    datasets: [{
      data: [30, 40, 20],
      backgroundColor: ['#2ED47A', '#FFB946', '#F7685B']
    }]
  };

  // Create the doughnut chart
  var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: {
      title: {
        display: true,
        text: 'My Doughnut Chart'
      },
      cutout: 55
    }
  });
</script>

@include('layouts.footer')