<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Password Reset</h2>
    <p>Hello, {{ $user->firstname }},</p>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p>Please click the button below to reset your password:</p>
    <a href="{{ $resetLink }}" class="button">Reset Password</a>
    <p>If you did not request a password reset, no further action is required.</p>
    <p>Regards,<br>MyDataClinic</p>
</body>
</html>
