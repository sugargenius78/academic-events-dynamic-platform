<?php
session_start();
$conn = new mysqli("localhost", "root", "Reem1234@", "website");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = trim($_POST['admin_id']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, email, password, role FROM users WHERE id = ? AND email = ?");
    $stmt->bind_param("is", $admin_id, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        if ($admin['role'] === 'admin' && password_verify($password, $admin['password'])) {
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['user_email'] = $admin['email'];
            $_SESSION['user_role'] = $admin['role'];

            header("Location: admin_index.html");
            exit();
        } else {
            echo "❌ Invalid password or not an admin.";
        }
    } else {
        echo "❌ Admin not found.";
    }

    $stmt->close();
}

$conn->close();
?>
