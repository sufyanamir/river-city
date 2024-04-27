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
        <p style="padding:20px 50px; font-size:large">Hello! <b style="color: #930027;">{{$emailData['name']}}</b> 
        You are getting this email because you are just registered to the <b>River City</b>. You can login to your account through giving address {{ $emailData['email'] }} and the password is <b>{{ $emailData['password'] }}</b>.</p>
        <br>
        <br>
        <div style=" margin-top: 8px; text-align: center;">
            <a href="https://thewebconcept.com/" style="color: #930027;">
                <span style="font-size: smaller; color:#930027; margin:auto;">Powered by : The Web Concept™.
                </span>
            </a>
        </div>
        <p style="padding:20px 50px; font-size:large"><a style="color: #930027;" href="https://paintwichita.com/">Visit our site!</a></p>
        <!-- <div style="text-align: left !important;">
            <img src="{{ asset('assets/images/PCA-Logo-RGB .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ asset('assets/images/2023BOW_GoldWInner.png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ asset('assets/images/Lead-Safe-EPA-Certified-Firm .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ asset('assets/images/workmanship.png') }}" class="footerImage" style="height: 80px;" alt="Image">
        </div> -->
    </div>
</body>

</html>