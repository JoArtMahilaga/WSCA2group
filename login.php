<?php
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="d-flex flex-column min-vh-100">

<main class="container mt-5 flex-grow-1">
    <h2 class="text-center text-primary">Login</h2>

    <?php
    // Display error message if set
    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);  // Clear error message after showing it
    }
    ?>

    <form action="login_process.php" method="POST" class="w-50 mx-auto">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</main>

<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p>&copy; <?php echo date("Y"); ?> My Website</p>
</footer>

</body>
</html>
