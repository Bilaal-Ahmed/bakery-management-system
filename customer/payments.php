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

// Fetch payments for the logged-in customer
$payments = [];
$stmt = $conn->prepare("SELECT * FROM payments WHERE C_ID = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $payments[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../templates/customer_header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Payments</h2>
        <?php if (count($payments) > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Order ID</th>
                        <th>Customer ID</th>
                        <th>Payment Date</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Transaction ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $payment): ?>
                        <tr>
                            <td><?php echo $payment['Pay_ID']; ?></td>
                            <td><?php echo $payment['O_ID']; ?></td>
                            <td><?php echo $payment['C_ID']; ?></td>
                            <td><?php echo $payment['Pay_Date']; ?></td>
                            <td><?php echo $payment['Amount']; ?></td>
                            <td><?php echo $payment['Pay_Method']; ?></td>
                            <td><?php echo $payment['Transaction_ID']; ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No payments found.</p>
        <?php endif; ?>
    </div>

    <?php include '../templates/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
