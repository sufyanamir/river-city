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
    </style>
</head>

<body>
    <div class="container">
        <p><b>Hello {{ $emailData['email'] }}!</b> We have made a proposal for you of the estimate. You can view or accept the proposal through this link</p>
        <a href="http://127.0.0.1:8007/viewProposal/{{ $emailData['estimate_id'] }}">View Proposal!</a>
        <br>
        <p><b>Thank You!</b></p>
        <i>Team <a href="https://scubadiving.thewebconcept.tech/">River City</a></i>
    </div>
</body>

</html>