<?php
session_start();
if (!isset($_SESSION['customer_logged_in'])) {
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
    <title>Customer Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Punjab Bakery</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../customer/dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../customer/view_products.php">View Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../customer/place_order.php">Place Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../customer/view_orders.php">View Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../customer/payments.php">Payments</a>
                </li>
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" name="query" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Welcome, <br>This is your customer dashboard! <?php echo $_SESSION['customer_name']; ?></h2>
        
    </div>
</body>
</html>
