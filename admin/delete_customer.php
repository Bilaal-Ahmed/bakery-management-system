<?php
session_start();
include('../db.php');

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$customerId = $_GET['id'];

// Delete the customer
if ($stmt = $conn->prepare("DELETE FROM customer WHERE C_ID = ?")) {
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $stmt->close();
}

header("Location: manage_customers.php");
exit();
?>
