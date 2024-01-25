<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <p>Dear Admin,</p>
    <p>A new candidate has recently registered on online aupairs and is awaiting for approval.</p>
    <p>Candidate Details:</p>
    <p>
        <ul>
            <li>Name: {{ isset($name) ? $name : null }}</li>
            <li>Email: {{ isset($email) ? $email : null }}</li>
            <li>Service: {{ isset($role) ? $role : null }}</li>
            <li>Registration Date: {{ isset($date) ? $date : null }}</li>
        </ul>
    </p>
    <p>Kind regards</p>
</body>
</html>