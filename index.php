<?php include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Home</title>
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-primary text-white text-center py-5">
    <h1>Welcome to My PHP Website</h1>
</header>

<main class="container mt-5 flex-grow-1">
    <h2 class="text-center text-primary">Home Page</h2>
    <p class="lead text-center">Welcome to the home page! You can login, register, or learn more about us.</p>
    <div class="text-center">
        <a href="login.php" class="btn btn-primary mx-2">Login</a>
        <a href="register.php" class="btn btn-secondary mx-2">Register</a>
    </div>
</main>

<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p>&copy; <?php echo date("Y"); ?> My Website</p>
</footer>

</body>
</html>
