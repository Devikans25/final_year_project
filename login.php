<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Database Connection
$servername = "localhost";
$username = "root";
$password = ""; // Default is empty
$database = "travel_planner";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

$email = $conn->real_escape_string($data['email']);
$password = $data['password'];

// Fetch user from database
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['password'])) {
        echo json_encode(["success" => "Login successful"]);
    } else {
        echo json_encode(["error" => "Invalid email or password"]);
    }
} else {
    echo json_encode(["error" => "User not found"]);
}

$conn->close();
?>
