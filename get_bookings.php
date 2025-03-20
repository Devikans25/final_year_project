<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->user_id)) {
    $user_id = $conn->real_escape_string($data->user_id);
    $query = "SELECT bookings.id, packages.title, bookings.date 
              FROM bookings 
              JOIN packages ON bookings.package_id = packages.id 
              WHERE bookings.user_id = '$user_id'";

    $result = $conn->query($query);

    $bookings = [];
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }

    echo json_encode($bookings);
}
?>
