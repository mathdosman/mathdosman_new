<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .body-content {
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover{
            background-color: #0056b3;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: center;
            font-size: 0.8em;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        @media screen and (max-width: 600px) {
            .container {
                padding: 0;
                margin: 10px auto;
            }
            .body-content, .header, .footer{
                padding: 10px;
            }
        }
        .warna{
            color: #f87103
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Reset Your Password</h2>
        </div>
        <div class="body-content">
            <p>Hello, {{ $user->name }}</p>
            <p>You have requested to reset your password. Please click the button below to proceed:</p>
            <div class="text-center">
                <a href="{{$actionLink}}" terget="_blank" class="button">Reset Password</a>
            </div>
            <p class="text-center warna">
                This link is valid for 15 minutes.
            </p>
            <p>If you did not request a password reset, please ignore this email or contact suport if you have questions.</p>
            <p>Thanks,</p>
            <p>Math Dosman Suport Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{date('Y')}} MATH DOSMAN. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
