<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proposal email</title>
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
        <p style="padding:20px 50px; font-size:large">Hello! <b style="color: #930027;">{{ $emailData['name'] }}</b> <br>
         Please Click on the link below to reset your password.</p>
        <a href="https://soft.rivercitypainting.tech/resetPassword/{{ $emailData['userId'] }}" style="padding:20px 50px; font-size:large; color:#930027;">Reset Password!</a>
        <br>
        <p style="padding:20px 50px; font-size:large"><b>Thank You!</b></p>
        <i style="padding:20px 50px; font-size:large">Team <a style="color: #930027;" href="https://paintwichita.com/">River City Painting</a></i>
        <!-- <div style="text-align: left !important; padding: 10px">
            <img src="{{ $message->embed(public_path().'/assets/images/PCA-Logo-RGB .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/2023BOW_GoldWInner.png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/Lead-Safe-EPA-Certified-Firm .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/workmanship.png') }}" class="footerImage" style="height: 80px;" alt="Image">
        </div> -->
    </div>
</body>

</html>