<?php
session_start();

// Destroy the session
session_destroy();

// Redirect to login page
header('Location: login.php');
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Patient Diet Determining Software</h1>
        <p>Logging out...</p>
    </header>

    <main>
        <section>
            <h2>You have been logged out successfully</h2>
            <p>Redirecting to login page...</p>
            <p>If you are not redirected automatically, <a href="login.php">click here</a>.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Chitungwiza Central Hospital - Diet System 2.0</p>
    </footer>

    <script>
        // Redirect after 3 seconds
        setTimeout(function() {
            window.location.href = 'login.php';
        }, 3000);
    </script>
</body>
</html>
