<?php
session_start();
include('../db.php');

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$employeeId = $_GET['id'];

// Delete the employee
if ($stmt = $conn->prepare("DELETE FROM employee WHERE E_ID = ?")) {
    $stmt->bind_param("i", $employeeId);
    $stmt->execute();
    $stmt->close();
}

header("Location: manage_employees.php");
exit();
?>
