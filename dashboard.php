<?php
include('navbar.php');

// Include the JWT decoding function
require_once 'utils/jwt_utils.php';

// Check if JWT is set in the session
if (!isset($_SESSION['jwt'])) {
    header('Location: login.php');  // If not logged in, redirect to login page
    exit();
}

try {
    // Get the JWT token from session
    $jwt = $_SESSION['jwt'];

    // Decode the JWT token
    $decoded = decode_jwt($jwt);

} catch (Exception $e) {
    // If JWT is invalid or expired, show an error and redirect to login
    echo "Access denied. " . $e->getMessage();
    session_destroy();  // Clear the session
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>


<div class="container mt-5">
    <h2><?php
        $payload = (array) $decoded;
        if (isset($payload['username'])) {
            $username = $payload['username'];
            echo "Hi, " . htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        } else {
            throw new Exception("Username not found in the JWT payload.");
        } ?>!
    </h2>
    <p>This is your dashboard. You are authenticated and authorized to view this page.</p>

    <!-- You can add data to be displayed here. For example, temperature data or any other info. -->
    <h3>Temperature Data</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Time</th>
            <th>Temperature (°C)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>10:00 AM</td>
            <td>25°C</td>
        </tr>
        <tr>
            <td>11:00 AM</td>
            <td>24°C</td>
        </tr>
        </tbody>
    </table>

    <!-- Add more content as needed -->

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
