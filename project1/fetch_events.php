<?php
$conn = new mysqli("localhost", "root", "Reem1234@", "website");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT title, event_date FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($event = $result->fetch_assoc()) {
        $title = htmlspecialchars($event['title']);
        $date = htmlspecialchars($event['event_date']);
        echo "<div class='card'>{$title}<br>{$date}</div>";
    }
} else {
    echo "<p>No events available</p>";
}
$conn->close();
?>
