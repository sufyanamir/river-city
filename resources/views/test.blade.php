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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proposal email</title>
    <style>
        .container{
            text-align: center;
            background-color: #f0f0f0;
            border-radius: 10px;
        }
        i{
            font-size: small;
            /* color: #f5f5f5; */
        }
        @media(max-width:1016px){
            .footerImage{
                height: 50px !important;
            }
        }
        .card-header{
            background-color: #930027;
            padding: 10px 0px 5px 0px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card-header">
            <img src="{{ $message->embed(public_path().'/assets/images/projectLogo.jpg') }}" alt="Hello">
        </div>
        <p><b>Hello {{ $emailData['email'] }}!</b> We have made a proposal for you of the estimate. You can view or accept the proposal through this link</p>
        <a href="https://soft.rivercitypainting.tech/viewProposal/{{ $emailData['estimate_id'] }}">View Proposal!</a>
        <br>
        <p><b>Thank You!</b></p>
        <i>Team <a style="color: #930027;" href="https://paintwichita.com/">River City Painting</a></i>
        <div style="text-align: left !important; padding: 10px">
            <img src="{{ $message->embed(public_path().'/assets/images/PCA-Logo-RGB .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/2023BOW_GoldWInner.png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/Lead-Safe-EPA-Certified-Firm .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/workmanship.png') }}" class="footerImage" style="height: 80px;" alt="Image">
        </div>
    </div>
</body>

</html>