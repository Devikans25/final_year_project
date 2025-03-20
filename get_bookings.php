<?php
include 'db.php'; // Ensure database connection is included

$sql = "SELECT users.id AS user_id, users.name, bookings.package_id, bookings.date 
        FROM bookings 
        JOIN users ON bookings.user_id = users.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Package ID</th>
                <th>Date</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['user_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['package_id']}</td>
                <td>{$row['date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No bookings found.";
}

$conn->close();
?>
