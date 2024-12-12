<?php
global $conn;
session_start();

// Include the database connection
require_once 'db.php';  // Make sure to have your db.php set up
require_once 'libs/php-jwt-main/src/JWT.php';  // Include the JWT library

use \Firebase\JWT\JWT;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Create a JWT token if the password is correct
            $key = "your_secret_key";  // Secret key for encoding/decoding JWT
            $payload = array(
                "iss" => "http://yourdomain.com",  // Issuer
                "aud" => "http://yourdomain.com",  // Audience
                "iat" => time(),  // Issued at
                "exp" => time() + 3600,  // Expiration time (1 hour)
                "username" => $user['username']  // Store the username in the payload
            );

            // Encode the payload to create JWT
            // Correctly pass all required arguments: $payload, $key, and $alg
            $jwt = JWT::encode($payload, $key, 'HS256');  // Specifying 'HS256' as the algorithm

            // Store the JWT in the session or send it as a response
            $_SESSION['jwt'] = $jwt;
//            echo "Login successful! JWT: " . $jwt;  // For demonstration purposes
            header("Location: index.php");
        } else {
            echo "Invalid username or password.";
            exit();
        }
    } else {
        echo "User not found.";
        exit();
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>
