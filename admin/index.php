<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include('../db.php');

// Fetch all necessary data
$products = $conn->query("SELECT COUNT(*) as count FROM product")->fetch_assoc()['count'];
$employees = $conn->query("SELECT COUNT(*) as count FROM employee")->fetch_assoc()['count'];
$customers = $conn->query("SELECT COUNT(*) as count FROM customer")->fetch_assoc()['count'];
$suppliers = $conn->query("SELECT COUNT(*) as count FROM supplier")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php include '../admin/admin_header.php'; ?>
    <div class="container mt-5">
        <div class="dashboard">
            <div class="header">
                <h1>Welcome, <?php echo $_SESSION['admin_name']; ?></h1>
                <p class="lead">Manage your bakery with ease</p>
            </div>

            <div class="stats">
                <div class="stat">
                    <h3><?php echo $products; ?></h3>
                    <p>Products</p>
                </div>
                <div class="stat">
                    <h3><?php echo $employees; ?></h3>
                    <p>Employees</p>
                </div>
                <div class="stat">
                    <h3><?php echo $customers; ?></h3>
                    <p>Customers</p>
                </div>
                <div class="stat">
                    <h3><?php echo $suppliers; ?></h3>
                    <p>Suppliers</p>
                </div>
            </div>

            <div class="row bakery-images">
                <div class="col-md-3">
                    <img src="../css/admin-dashboard.jpg" alt="Bakery Image" class="img-fluid rounded">
                </div>
                <div class="col-md-3">
                    <img src="../css/admin-login.jpg" alt="Bakery Image" class="img-fluid rounded">
                </div>
                <div class="col-md-3">
                    <img src="../css/biryani-order.jpg" alt="Bakery Image" class="img-fluid rounded">
                </div>
                <div class="col-md-3">
                    <img src="../css/index-admin.jpg" alt="Bakery Image" class="img-fluid rounded">
                </div>
            </div>

            <div class="about-section mt-4">
                <h2>About Our Bakery</h2>
                <p>Welcome to our bakery! We offer a wide variety of baked goods made from the freshest ingredients. Our dedicated team of bakers and staff work tirelessly to bring you the best quality products.</p>
            </div>
        </div>
    </div>
    <?php include '../templates/footer.php'; ?>
</body>
</html>
