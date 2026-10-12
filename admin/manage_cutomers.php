<?php
include('../db.php');
session_start();

if (!isset($_SESSION['admin_email'])) {
    header('Location: login.php');
    exit();
}

$customers = [];
$query = "SELECT * FROM customer";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $customers[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../admin/admin_header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Manage Customers</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Loyalty Points</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?php echo $customer['C_ID']; ?></td>
                        <td><?php echo $customer['C_Name']; ?></td>
                        <td><?php echo $customer['C_Email']; ?></td>
                        <td><?php echo $customer['C_Address']; ?></td>
                        <td><?php echo $customer['LoyaltyPoints']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include '../templates/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
