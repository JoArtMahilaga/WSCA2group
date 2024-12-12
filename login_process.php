<?php
session_start();

// Include the database connection
global $conn;
include('db.php');


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

        // Verify the password using password_hash
        if (password_verify($password, $user['password'])) {
            // Password is correct, create a session
            $_SESSION['user_id'] = $user['id']; // Save the user ID in the session
            $_SESSION['username'] = $user['username']; // Save the username

            echo "Login successful!";
            // Redirect to the homepage
            header("Location: index.php");
            exit();
        } else {
            echo "Login failed!";
            // Password is incorrect, set error message in session
            $_SESSION['error_message'] = "Invalid username or password.";
        }
    } else {
        // User not found, set error message in session
        $_SESSION['error_message'] = "Invalid username or password.";
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}

