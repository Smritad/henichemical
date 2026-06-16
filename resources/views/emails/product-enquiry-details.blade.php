<!DOCTYPE html>
<html>
<head>
    <title>Product Enquiry Details:</title>
</head>
<body>
    <p>Product Enquiry Details:</p>
    <ul>
        <li>Product Name: {{$product_name}}</li>
        <li>Name: {{$name}}</li>
        <li>Email: {{$email}}</li>
        <li>Mobile No: {{$mobile_no}}</li>
        @if($user_message != "")
            <li>Message: {{$user_message}}</li>
        @endif
    </ul>

    <p>Best regards,</p>
    <p>Team Heni Chemicals</p>
</body>
</html>