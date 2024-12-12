<?php
// Include the database connection
global $conn;
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the username or email already exists
    $checkUserQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        echo "Username or Email already exists!";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Registration successful! You can now <a href='login.php'>login</a>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Close the connection
    $conn->close();
}

