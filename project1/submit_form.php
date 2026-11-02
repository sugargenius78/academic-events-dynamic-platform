<?php

$conn = new mysqli("localhost", "root", "Reem1234@", "website");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$fullName = isset($_POST['Full_Name']) ? trim($_POST['Full_Name']) : '';
$email = isset($_POST['email_address']) ? trim($_POST['email_address']) : '';
$eventName = isset($_POST['Event_Name']) ? trim($_POST['Event_Name']) : '';
$user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : ''; // Now taken from the form




$sql = "INSERT INTO event_registrations (full_name, email, user_id, event_name) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("❌ Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssis", $fullName, $email, $user_id, $eventName);

if ($stmt->execute()) {
   
    header("Location: index.html");
    exit();
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
