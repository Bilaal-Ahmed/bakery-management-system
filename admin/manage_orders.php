<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include('../db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../admin/admin_header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Manage Orders</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Delivery Method</th>
                    <th>Delivery Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM Orders";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['O_ID']}</td>
                        <td>{$row['C_ID']}</td>
                        <td>{$row['Order_Date']}</td>
                        <td>{$row['Status']}</td>
                        <td>{$row['Due_Date']}</td>
                        <td>{$row['Delivery_Method']}</td>
                        <td>{$row['Delivery_Address']}</td>
                        <td>
                            <a href='view_order.php?id={$row['O_ID']}' class='btn btn-primary btn-sm'>View</a>
                            <a href='delete_order.php?id={$row['O_ID']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include '../templates/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
