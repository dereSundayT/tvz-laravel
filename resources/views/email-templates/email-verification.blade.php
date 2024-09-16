<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            text-align: left;
        }
        .header {
            font-size: 28px;
            color: #6c63ff;
            font-family: 'Georgia', serif;
            font-weight: bold;
        }
        .image-container {
            margin: 20px 0;
        }
        .image-container img {
            width: 120px;
        }
        .content {
            font-size: 18px;
            color: #333333;
            line-height: 1.6;
        }
        .button-container {
            margin: 0px 0;
        }
        .button {
            background-color: #6c63ff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 14px;
            border-radius: 5px;
        }
        .footer {
            font-size: 12px;
            color: #999999;
            margin-top: 20px;
        }
        .footer a {
            color: #6c63ff;
            text-decoration: none;
        }
        .social-icons {
            margin: 20px 0;
        }
        .social-icons img {
            width: 30px;
            margin: 0 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        {{ config('app.name') }}
    </div>

    <!-- Content -->
    <div class="content">
        <p>Dear {{$emailData['name']}}</p>
        <p>
            Thanks for signing up on {{config('app.name')}}. <br/>
            Please click the button below to confirm your email and start socializing with friends.
        </p>
    </div>

    <!-- Button -->
    <div class="button-container">
        <a href="{{$emailData['verification_link']}}" class="button">CONFIRM EMAIL</a>
    </div>

    <br/>
    <div>
        <a href="{{$emailData['verification_link']}}">{{$emailData['verification_link']}}</a>
    </div>

    <p>If you did not create an account, no further action is required.</p>
    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>

</div>
</body>
</html>
