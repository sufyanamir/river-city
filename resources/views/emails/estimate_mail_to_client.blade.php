<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $emailData['email_subject'] }}</title>
    <style>
        .container{
            text-align: center;
            background-color: #f0f0f0;
            border-radius: 10px;
        }

        i {
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
        @php
        // Process email body to convert text within [] into links and remove text within []
        $emailBody = $emailData['email_body'];
        
        

        // Process email body to convert remaining text within [] into links
        preg_match_all('/\[(.*?)\]/', $emailBody, $matches);
        preg_match_all('/\{(.*?)\}/', $emailBody, $matchestitle);
        $urls = [];
        $urlTitles = [];
        foreach ($matches[1] as $key => $match) {
            $link = '<a href="' . $match . '">' . $matchestitle[1][$key] . '</a>';
            $emailBody = str_replace("[$match]", $link, $emailBody);
            $urls[] = $match;
            $urlTitles[] = $matchestitle[1][$key];  
        }
        // Remove text within [] and {} symbols
        $emailBody = preg_replace('/\[(.*?)\]/', '', $emailBody);
        $emailBody = preg_replace('/\{(.*?)\}/', '', $emailBody);
        // Remove the <a> tags from the email body
        $emailBody = strip_tags($emailBody);
        @endphp
        <p><b>Hello {{ $emailData['email_to'] }}!</b> {!! $emailBody !!}</p>
        @foreach($urls as $key => $url)
        <a href="{{$url}}">{{$urlTitles[$key]}}</a><br>
        @endforeach
        <br>
        <p><b>Thank You!</b></p>
        <i>Team <a style="color: #930027;" href="https://paintwichita.com/">River City Painting</a></i>
        <div style="text-align: left !important; padding:10px">
            <img src="{{ $message->embed(public_path().'/assets/images/PCA-Logo-RGB .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/2023BOW_GoldWInner.png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/Lead-Safe-EPA-Certified-Firm .png') }}" class="footerImage" style="height: 80px;" alt="Image">
            <img src="{{ $message->embed(public_path().'/assets/images/workmanship.png') }}" class="footerImage" style="height: 80px;" alt="Image">
        </div>
    </div>
</body>

</html>
