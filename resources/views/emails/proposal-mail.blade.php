<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$emailData['subject'] ?? 'Estimate'}}</title>
    <style>
        .container{
            /* text-align: justify; */
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
            <img src="https://soft.rivercitypainting.tech/assets/images/projectLogo.jpg" alt="Hello">
        </div>
        <p style="padding:20px 50px; font-size:large">
        <?php echo nl2br($emailData['body']); ?>
        <br>
        <br>
        <a href="https://soft.rivercitypainting.tech/{{'customerPortal/' . $emailData['customer_id']}}" style="color: #930027;">Click here to view!</a>
        <br>
        <br>
        @if($emailData['branch'] == 'kansas')
        <p style="padding:20px 50px; font-size:large"><a style="color: #930027;" href="https://rivercitypaintinginc.com/">Visit our site!</a></p>
        @else
        <p style="padding:20px 50px; font-size:large"><a style="color: #930027;" href="https://paintwichita.com/">Visit our site!</a></p>
        @endif
        <!-- <div style=" margin-top: 8px; text-align: center;">
            <a href="https://thewebconcept.com/" style="color: #930027;">
                <span style="font-size: smaller; color:#930027; margin:auto;">Powered by : The Web Concept™.
                </span>
            </a>
        </div> -->
        <div style=" padding:20px 50px;">
            
            <img src="https://soft.rivercitypainting.tech/assets/images/PCA-Logo-RGB%20.png" class="footerImage" style="height: 80px;" alt="Image">
            <img src="https://soft.rivercitypainting.tech/assets/images/RCP-Badges-02.png" class="footerImage" style="height: 80px;" alt="Image">
            <img src="https://soft.rivercitypainting.tech/assets/images/Lead-Safe-EPA-Certified-Firm%20.png" class="footerImage" style="height: 80px;" alt="Image">
            <img src="https://soft.rivercitypainting.tech/assets/images/RCP-Badges-01.png" class="footerImage" style="height: 80px;" alt="Image">
        </div>
    </div>
</body>

</html>