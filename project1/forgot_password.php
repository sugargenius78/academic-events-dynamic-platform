<?php
session_start();
$conn = new mysqli("localhost", "root", "Reem1234@", "website");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);

    
    $result = $conn->query("SELECT user_id FROM users WHERE email = '$email'");
    if ($result->num_rows == 0) {
        $error = "Email not found.";
    } else {
        
        $reset_code = rand(100000, 999999);
        $expires_at = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        
        $conn->query("DELETE FROM users WHERE email = '$email'"); 
        $stmt = $conn->prepare("INSERT INTO users(email, reset_password, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $email, $reset_code, $expires_at);
        $stmt->execute();
        $stmt->close();

        
        $subject = "Your Password Reset Code";
        $message = "Your password reset code is: $reset_code. It expires in 15 minutes.";
        $headers = "From: no-reply@example.com";

        mail($email, $subject, $message, $headers);

        $_SESSION['reset_email'] = $email;
        header("Location: verify_code.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 360px;
            margin: 80px auto;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #2c3e50;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            color: #34495e;
        }

        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1.5px solid #bdc3c7;
            margin-bottom: 20px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus,
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #2980b9;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #2980b9;
            color: white;
            border: none;
            font-weight: 700;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1c5980;
        }

        .error {
            color: #e74c3c;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>

</head>
<body>
    <div class="container">
    <h2>Reset Password</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" action="reset_password.php">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required>

        <label for="new_password">New Password</label>
        <input type="password" id="new_password" name="new_password" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit">Reset Password</button>
    </form>
</div>

</body>
</html>
