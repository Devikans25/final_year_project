<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->user_id) && isset($data->package_id) && isset($data->date)) {
    $user_id = $conn->real_escape_string($data->user_id);
    $package_id = $conn->real_escape_string($data->package_id);
    $date = $conn->real_escape_string($data->date);

    $query = "INSERT INTO bookings (user_id, package_id, date) VALUES ('$user_id', '$package_id', '$date')";
    
    if ($conn->query($query)) {
        echo json_encode(["message" => "Booking confirmed"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
}
?>
