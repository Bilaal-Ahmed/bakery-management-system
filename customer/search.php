<?php
include('../db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['C_Email'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

$customer_email = $_SESSION['C_Email'];
$search_results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = '%' . $_POST['search'] . '%';

    // Fetch customer information
    $stmt = $conn->prepare("SELECT * FROM customer WHERE C_Email = ?");
    $stmt->bind_param("s", $customer_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();
    $customer_id = $customer['C_ID'];
    $stmt->close();

    // Search orders
    $stmt = $conn->prepare("SELECT * FROM orders WHERE C_ID = ? AND (O_ID LIKE ? OR Order_Date LIKE ? OR Status LIKE ? OR Due_Date LIKE ? OR Delivery_Method LIKE ? OR Delivery_Address LIKE ?)");
    $stmt->bind_param("issssss", $customer_id, $search_query, $search_query, $search_query, $search_query, $search_query, $search_query);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $search_results['orders'][] = $row;
    }
    $stmt->close();

    // Search payments
    $stmt = $conn->prepare("SELECT * FROM payments WHERE C_ID = ? AND (Pay_ID LIKE ? OR O_ID LIKE ? OR Payment_Date LIKE ? OR Amount LIKE ? OR Payment_Method LIKE ?)");
    $stmt->bind_param("isssss", $customer_id, $search_query, $search_query, $search_query, $search_query, $search_query);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $search_results['payments'][] = $row;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../templates/customer_header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Search Results</h2>
        <form action="search.php" method="post" class="form-inline my-4">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php if (!empty($search_results)): ?>
            <?php if (!empty($search_results['orders'])): ?>
                <h3>Orders</h3>
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
                        <?php foreach ($search_results['orders'] as $order): ?>
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
            <?php endif; ?>

            <?php if (!empty($search_results['payments'])): ?>
                <h3>Payments</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Order ID</th>
                            <th>Payment Date</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($search_results['payments'] as $payment): ?>
                            <tr>
                                <td><?php echo $payment['Pay_ID']; ?></td>
                                <td><?php echo $payment['O_ID']; ?></td>
                                <td><?php echo $payment['Payment_Date']; ?></td>
                                <td><?php echo $payment['Amount']; ?></td>
                                <td><?php echo $payment['Payment_Method']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php else: ?>
            <p class="text-center">No results found.</p>
        <?php endif; ?>
    </div>

    <?php include '../templates/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
