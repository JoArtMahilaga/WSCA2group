<?php
session_start();
require_once('utils/jwt_utils.php'); // Include the JWT utility file

// Check if there's a JWT in the session or request (adjust as necessary)
$jwt = isset($_SESSION['jwt']) ? $_SESSION['jwt'] : null;

// Decode the JWT to get the payload (if JWT exists)
$userData = null;
if ($jwt) {
    $userData = decode_jwt($jwt); // Decode the JWT to get user data
}

// Extract username if the user is logged in
$username = $userData ? $userData['username'] : null;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- If user is logged in, display their username. Otherwise, display the default website name. -->
        <a class="navbar-brand" href="index.php">
            <?php
            if ($username) {
                echo "Welcome, " . htmlspecialchars($username); // Display username if logged in
            } else {
                echo "My Website"; // Default text if not logged in
            }
            ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto"> <!-- ms-auto centers the links -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if (!$username) { // Only show Login and Register if not logged in ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php } else { // If logged in, show Dashboard and Logout ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a> <!-- Dashboard link -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS and dependencies (at the end of the body tag) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
