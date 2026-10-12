<?php
session_start();
include('../db.php');

$error = ""; // Store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare statement to prevent SQL Injection
    $stmt = $conn->prepare("SELECT * FROM employee WHERE Email = ? AND Role = 'admin'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $row['E_Password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_name'] = $row['E_Name']; // Store admin name
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password. Please try again. ❌";
        }
    } else {
        $error = "No admin found with this email. ⚠️";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login 🍩</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff7e6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: #ffebcc;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #5a3e36;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 25px;
            padding: 10px;
            border: 1px solid #d6a57c;
        }
        .btn-custom {
            background-color: #ff9f43;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 25px;
            transition: 0.3s;
            width: 100%;
        }
        .btn-custom:hover {
            background-color: #ff6f00;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Admin Login 👨‍💼</h2>
        <?php if ($error): ?>
            <p class="error-message"><?= $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">📧 Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">🔑 Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-custom">Login 🚀</button>
        </form>
    </div>

</body>
</html>
