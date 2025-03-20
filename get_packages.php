<?php
require 'db.php';

$query = "SELECT * FROM packages";
$result = $conn->query($query);

$packages = [];
while ($row = $result->fetch_assoc()) {
    $packages[] = $row;
}

echo json_encode($packages);
?>
