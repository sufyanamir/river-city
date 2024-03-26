<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation</title>
    <style>
        .container{
            text-align: justify;
            background-color: #f0f0f0;
            border-radius: 10px;
            /* width: 800px; */
            margin: 0 auto;
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
        <div class="card-header" style="text-align: center;">
            <img src="{{ $message->embed(public_path().'/assets/images/projectLogo.jpg') }}" alt="Hello">
        </div>
        <p>Hello! <b style="color: #930027;">{{$emailData['name']}}</b> 
        You are getting this email because you are just registered to the <b>River City</b>. You can login to your account through giving address {{ $emailData['email'] }} and the password is <b>{{ $emailData['password'] }}</b>.</p>
        <br>
        <p><b>Thank You!</b></p>
        <i>Team <a style="color: #930027;" href="https://paintwichita.com/">River City Painting</a></i>
        <!-- <div style="text-align: left !important;">
            <img src="{{ asset('assets/images/PCA-Logo-RGB .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ asset('assets/images/2023BOW_GoldWInner.png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ asset('assets/images/Lead-Safe-EPA-Certified-Firm .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ asset('assets/images/workmanship.png') }}" class="footerImage" style="height: 80px;" alt="Image">
        </div> -->
    </div>
</body>

</html>