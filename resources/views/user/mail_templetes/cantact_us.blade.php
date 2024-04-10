<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">  
        <p>Hello Admin,</p>
        
        <p>You have received a new message from the contact form on your website. Below are the details:</p>
        
        <p><strong>Name:</strong>{{ isset($name) ? $name : "" }}</p>
        <p><strong>Email:</strong>{{ isset($email) ? $email : "" }}</p>
        <p><strong>Message:</strong></p>
        <blockquote>
            {{ isset($messages) ? $messages : "" }}
        </blockquote>

        <p>Please respond to the sender at their provided email address.</p>

        <p>Thank you!</p>
    </div>
</body>
</html>
