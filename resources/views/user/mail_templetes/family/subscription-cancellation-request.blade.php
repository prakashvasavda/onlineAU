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
        <p>Dear Admin,</p>
        
        <p>I am requesting for the cancellation of my subscription with the following details</p>
        
        <p><strong>Name:</strong>{{ isset($name) ? ucfirst($name) : "" }}</p>
        <p><strong>Package Name:</strong>{{ isset($package_name) ? ucfirst($package_name) : "" }}</p>
        
        <p>Thank you for your prompt attention to this matter.</p>

        <p>Sincerely</p>
    </div>
</body>
</html>
