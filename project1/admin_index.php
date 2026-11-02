<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: admin.html");
    exit();
}

$conn = new mysqli("localhost", "root", "Reem1234@", "website");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $event_date = $_POST['event_date'];
    $created_by = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO events (title, description, event_date, created_by) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $title, $description, $event_date, $created_by);

    if ($stmt->execute()) {
        header("Location: admin_index.php?event_added=1");
        exit();
    } else {
        echo "Error adding event: " . $stmt->error;
    }

    $stmt->close();
}
?>

<?php if (isset($_GET['event_added'])): ?>
    <p style="color: lightgreen;">Event added successfully!</p>
<?php endif; ?>

<div class="main-content">
    <h2>All Events</h2>
    <?php
    $result = $conn->query("SELECT * FROM events ORDER BY event_date DESC");

    if ($result && $result->num_rows > 0) {
        while ($event = $result->fetch_assoc()) {
            echo "<div class='event-card'>";
            echo "<h3>" . htmlspecialchars($event['title']) . "</h3>";
            echo "<p><strong>Date:</strong> " . htmlspecialchars($event['event_date']) . "</p>";
            echo "<p>" . nl2br(htmlspecialchars($event['description'])) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No events found.</p>";
    }

    $conn->close();
    ?>
</div>
