<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changed Successfully</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #097c22;
            color: #e6e6e6;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 30px;
        }
        .content p {
            margin-bottom: 20px;
        }
        .info-box {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .info-box p {
            margin: 5px 0;
        }
        .info-box strong {
            font-weight: 600;
        }
        .footer {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
            font-size: 0.8em;
            color: #777;
        }
        @media screen and (max-width: 600px) {
            .container {
                margin: 10px auto;
            }
            .header, .content, .footer {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Password Changed Successfully</h1>
        </div>
        <div class="content">
            <h4>Hello, {{ $user->name }},</h4>
            <p>Your password has been successfully changed. Below are your updated credentials. Please keep them in a safe place.</p>
            <div class="info-box">
                <p><strong>Username/Email:</strong> {{ $user->email }} or {{ $user->username }}</p>
                <p><strong>New Password:</strong> {{ $new_password }}</p>
            </div>
            <p>If you did not make this change, please contact us immediately.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Math Dosman. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
