<?php
session_start();

$conn = new mysqli("localhost", "root", "Reem1234@", "website");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();}
    
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];

                header("Location: form.html");
                exit();
            } else {
                $_SESSION['error_message'] = "Incorrect password.";
                header("Location: sign.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "User not found.";
            header("Location: sign.php");
            exit();
        }

        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Please fill all fields.";
        header("Location: sign.php");
        exit();
    }
} else {
    header("Location: index.html");
    exit();
}

$conn->close();
?>
