<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal Accepted</title>
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
        <img src="{{ $message->embed(public_path().'/assets/images/projectLogo.jpg') }}" alt="company image">
        </div>
        <p style="padding:20px 50px; font-size:large">
        <b>{{$emailData['customer_name']}}</b> just accepted the proposal of their estimate. Click on the link below to view proposal.
        <br>
        <br>
        <a href="https://soft.rivercitypainting.tech/viewProposal/{{$emailData['estimate_id']}}" style="color: #930027;">Click Here to see the proposal.</a>
        <br>
        <br>
        
    </div>
</body>

</html>