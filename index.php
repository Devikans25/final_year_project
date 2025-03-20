<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: customer-login.html"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE TRAVEL PLANNING & BOOKING PLATFORM</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Voyago.!</h1>
        <p>Online Travel Agency | Travel Booking</p>
    </header>

    <main>
        <div class="welcome">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
            <p>Start planning your trip now.</p>
        </div>
        <div class="button-container">
            <a href="logout.php">
                <button>Logout</button>
            </a>
        </div>
    </main>

</body>
</html>
