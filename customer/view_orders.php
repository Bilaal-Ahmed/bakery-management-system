<?php
include('../db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['C_Email'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

// Fetch the customer's email from the session
$customer_email = $_SESSION['C_Email'];

// Fetch customer information from the database
$stmt = $conn->prepare("SELECT * FROM customer WHERE C_Email = ?");
$stmt->bind_param("s", $customer_email);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();
$customer_id = $customer['C_ID'];
$stmt->close();

// Fetch orders for the logged-in customer
$orders = [];
$stmt = $conn->prepare("SELECT * FROM orders WHERE C_ID = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../templates/customer_header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Your Orders</h2>
        <?php if (count($orders) > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Delivery Method</th>
                        <th>Delivery Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo $order['O_ID']; ?></td>
                            <td><?php echo $order['Order_Date']; ?></td>
                            <td><?php echo $order['Status']; ?></td>
                            <td><?php echo $order['Due_Date']; ?></td>
                            <td><?php echo $order['Delivery_Method']; ?></td>
                            <td><?php echo $order['Delivery_Address']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No orders found.</p>
        <?php endif; ?>
    </div>

    <?php include '../templates/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
