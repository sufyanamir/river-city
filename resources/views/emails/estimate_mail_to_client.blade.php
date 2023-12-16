<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $emailData['email_subject'] }}</title>
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
        <p><b>Hello {{ $emailData['email_to'] }}!</b> {{ $emailData['email_body'] }}</p>
        <br>
        <p><b>Thank You!</b></p>
        <i>Team <a href="https://scubadiving.thewebconcept.tech/">River City</a></i>
    </div>
</body>

</html>