<?php
session_start();
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];

    // Assuming you want to store the messages in a database table named 'messages'
    $stmt = $conn->prepare("INSERT INTO messages (sender, message, sent_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $_SESSION['admin_name'], $message);

    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
