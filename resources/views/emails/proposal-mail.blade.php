<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proposal email</title>
    <style>
        .container{
            text-align: center;
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
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ $message->embed(public_path().'/assets/images/projectLogo.jpg') }}" alt="Hello">
        <p><b>Hello {{ $emailData['email'] }}!</b> We have made a proposal for you of the estimate. You can view or accept the proposal through this link</p>
        <a href="https://rivercity.thewebconcept.tech/viewProposal/{{ $emailData['estimate_id'] }}">View Proposal!</a>
        <br>
        <p><b>Thank You!</b></p>
        <i>Team <a href="https://paintwichita.com/">River City</a></i>
        <div style="text-align: left !important;">
            <img src="{{ $message->embed(public_path().'/assets/images/PCA-Logo-RGB .png') }}" class="footerImage" style="height: 100px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/2023BOW_GoldWInner.png') }}" class="footerImage" style="height: 100px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/Lead-Safe-EPA-Certified-Firm .png') }}" class="footerImage" style="height: 100px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/workmanship.png') }}" class="footerImage" style="height: 100px;" alt="Image">
        </div>
    </div>
</body>

</html>