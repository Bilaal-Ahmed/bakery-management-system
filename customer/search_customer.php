<!-- customer/search_customer.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Search</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../templates/customer_header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Customer Search</h2>
        <form action="view_orders.php" method="post">
            <div class="form-group">
                <label for="name">Enter Your Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Search Orders</button>
        </form>
        <form action="view_products.php" method="get" class="mt-3">
            <button type="submit" class="btn btn-secondary">View Products</button>
        </form>
    </div>

    <?php include '../templates/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
