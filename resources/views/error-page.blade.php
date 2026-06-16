<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | HENI Chemicals</title>
    <meta name="description" content="The page you are looking for was not found. Go back to the homepage.">

    <!-- Add your CSS here -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
            font-family: Arial, sans-serif;
        }
        .error-section {
            padding: 80px 20px;
            text-align: center;
        }
        .error-code {
            font-size: 96px;
            font-weight: bold;
            color: #007bff;
        }
        .error-message {
            font-size: 24px;
            margin-top: 20px;
        }
        .btn-home {
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <div class="error-section">
        <div class="error-code">404</div>
        <div class="error-message">Oops! Page not found.</div>
        <p>The page you are looking for might have been removed,<br> had its name changed, or is temporarily unavailable.</p>
        <a href="{{ route('/') }}" class="btn btn-primary btn-home">Back to Home</a>
    </div>

</body>
</html>
