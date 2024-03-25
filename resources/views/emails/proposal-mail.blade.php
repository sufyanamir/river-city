<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$emailData['title']}}</title>
    <style>
        .container{
            text-align: center;
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
        <div class="card-header">
            <img src="{{ $message->embed(public_path().'/assets/images/projectLogo.jpg') }}" alt="Hello">
        </div>
        <p style="padding:20px 50px">
        {{$emailData['body']}}
        <br>
        <a href="https://soft.rivercitypainting.tech/viewProposal/{{$emailData['estimate_id']}}" style="color: #930027;">You can see your proposal Here</a>
        <br>
            Thank you for considering our offering.</p>
        <p><b>Thank You!</b></p>
        <i>Team <a style="color: #930027;" href="https://paintwichita.com/">River City Painting</a></i>
        <div style=" padding: 10px">
            <img src="{{ $message->embed(public_path().'/assets/images/PCA-Logo-RGB .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/2023BOW_GoldWInner.png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/Lead-Safe-EPA-Certified-Firm .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/workmanship.png') }}" class="footerImage" style="height: 80px;" alt="Image">
        </div>
    </div>
</body>

</html>