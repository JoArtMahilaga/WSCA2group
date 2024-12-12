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
            // BETTER STORE IN ENV VARIABLE!!
            // But we are not in prod, so doesn't matter ;)
            $key = "2172464e069513a0c765af87bd3fdc4fb1d720e9076384399494fab8447d631dd36460eca5b6360ba01898dec1f142855440c4550dccfdae70dcb24d57e0c75b3745ec5b5246d52b2332b8222910e2e2563c4cdf5afd781c374839a60104600efbd24414c7d4f2c4f2ac6f59672fdaf33b308692fc14536ac2f23ad0884436c9c91f1044eca64ed575d4b87f234cd2153e783821db3873cea5fe6c613e45a224f208c41f66968d3917a16f306fbb35fcf6fd106a0fdcb25f1db5e99e98e26266c45808b3dabaf9f6bb6f1f8036465e221df6968cecb56e522c123bffbaa8a308d25a7b6928e4083dd8ec3b0f37a3f347448736d7296312e86f059305a1e453d4";  // Secret key for encoding/decoding JWT
            $payload = array(
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
