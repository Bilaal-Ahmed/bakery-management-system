<?php
session_start();
include('../db.php');

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../admin/admin_header.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">About Us</h2>
        <p>
            Welcome to Punjab Bakery! We are a family-owned bakery that has been serving the community for over 20 years.
            Our mission is to provide our customers with the highest quality baked goods made from the finest ingredients.
            From freshly baked bread to delicious cakes and pastries, we have something for everyone.
        </p>
        <p>
            Our team is dedicated to bringing you the best baking experience possible. We believe in using traditional
            recipes and baking techniques to ensure that our products are always fresh and flavorful. Thank you for choosing
            Punjab Bakery, and we look forward to serving you!
        </p>
    </div>
    <?php include '../templates/footer.php'; ?>
</body>
</html>
