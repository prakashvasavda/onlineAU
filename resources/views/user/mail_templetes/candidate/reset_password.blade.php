<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <p>Dear {{ isset($name) ? $name : null }},</p>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p>Click the following link to reset your password:</p>
    <a href="{{ isset($url) ? $url : '#'}}">Reset Password</a>
    <p>If you did not request a password reset, no further action is required.</p>
    <p>Kind regards</p>
</body>
</html>