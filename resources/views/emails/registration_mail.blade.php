<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation</title>
    <style>
        .container{
            text-align: center;
        }
        i{
            font-size: small;
            /* color: #f5f5f5; */
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ $message->embed(public_path().'/assets/images/projectLogo.jpg') }}" alt="Hello">
        <p><b>Hello dear!</b> You are getting this email because you are just registered to the <b>River City</b>. You can login to your account through giving address {{ $emailData['email'] }} and the password is <b>{{ $emailData['password'] }}</b>.</p>
        <br>
        <p><b>Thank You!</b></p>
        <i>Team <a href="https://paintwichita.com/">River City</a></i>
        <div style="text-align: left !important;">
            <img src="{{ $message->embed(public_path().'/assets/images/PCA-Logo-RGB .png') }}" style="height: 100px !important;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/2023BOW_GoldWInner.png') }}" style="height: 100px !important;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/Lead-Safe-EPA-Certified-Firm .png') }}" style="height: 100px !important;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/workmanship.png') }}" style="height: 100px !important;" alt="Image">
        </div>
    </div>
</body>

</html>