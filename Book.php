<?php
require 'db.php'; // Include Database Connection

header("Content-Type: application/json");

// Get raw POST data
$data = json_decode(file_get_contents("php://input"));

if (!isset($data->user_id) || !isset($data->package_id) || !isset($data->date)) {
    echo json_encode(["message" => "Missing required fields"]);
    exit();
}

$user_id = $conn->real_escape_string($data->user_id);
$package_id = $conn->real_escape_string($data->package_id);
$date = $conn->real_escape_string($data->date);

// Check if the user and package exist
$user_check = $conn->query("SELECT id FROM users WHERE id = '$user_id'");
$package_check = $conn->query("SELECT id FROM packages WHERE id = '$package_id'");

if ($user_check->num_rows === 0 || $package_check->num_rows === 0) {
    echo json_encode(["message" => "Invalid user or package ID"]);
    exit();
}

// Insert booking
$query = "INSERT INTO bookings (user_id, package_id, date) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iis", $user_id, $package_id, $date);

if ($stmt->execute()) {
    echo json_encode(["message" => "Booking confirmed"]);
} else {
    echo json_encode(["message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
