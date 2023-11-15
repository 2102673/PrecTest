<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_password'])) {
    // If not logged in, redirect to index.php
    header("Location: index.php");
    exit();
}

$userPassword = $_SESSION['user_password'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome Page</title>
</head>

<body>

    <div>
        <h1>Welcome to Our Website</h1>
        <p>Your password: <?php echo htmlspecialchars($userPassword); ?></p>
        <form action="logout.php" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>

</body>

</html>