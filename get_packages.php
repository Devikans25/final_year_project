<?php
require 'db.php'; // Ensure this file connects to your database

header("Content-Type: application/json");

// Query to fetch package details
$query = "SELECT id, title, description, price, duration FROM packages";
$result = $conn->query($query);

$packages = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
    echo json_encode($packages);
} else {
    echo json_encode(["error" => "No packages found"]);
}

$conn->close();
?>
