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
        <p>Dear Family,</p>
        
        <p>We're thrilled to share that a new Online Au Pair candidate from <i>{{ isset($area) ? $area : "" }}</i> has just joined our platform. Here are a few details about them:</p>
        
        <p><strong>Name:</strong>{{ isset($name) ? ucfirst($name) : "" }}</p>
        <p><strong>Service:</strong>{{ isset($role) ? ucfirst($role) : "" }}</p>
        <p><strong>Experience:</strong>{{ isset($childcare_experience) ? $childcare_experience : "" }}</p>
        <p><strong>About The candidate:</strong></p>
        <blockquote>
            {{ isset($about_yourself) ? $about_yourself : "" }}
        </blockquote>

        <p>Login now to view their complete profile and explore if they could be the perfect match for your family</p>

        <p>Thank you!</p>
    </div>
</body>
</html>
