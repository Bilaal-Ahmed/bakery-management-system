<?php
include('../db.php');

// Fetch products from the 'product' table
$products = [];
$query = "SELECT * FROM product";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $delivery_method = $_POST['delivery_method'];
    $delivery_address = $_POST['delivery_address'];
    
    // Get customer ID
    $stmt = $conn->prepare("SELECT C_ID FROM customer WHERE C_Name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();
    
    if ($customer) {
        $customer_id = $customer['C_ID'];
        $stmt->close();
        
        // Insert order
        $stmt = $conn->prepare("INSERT INTO orders (C_ID, Order_Date, Status, Due_Date, Delivery_Method, Delivery_Address) VALUES (?, NOW(), 'Pending', DATE_ADD(NOW(), INTERVAL 7 DAY), ?, ?)");
        $stmt->bind_param("iss", $customer_id, $delivery_method, $delivery_address);
        $stmt->execute();
        $order_id = $stmt->insert_id;
        $stmt->close();
        
        // Insert order details
        $stmt = $conn->prepare("INSERT INTO order_details (O_ID, P_ID, Quantity, Total_Price) VALUES (?, ?, ?, (SELECT Price FROM product WHERE P_ID = ?) * ?)");
        $stmt->bind_param("iiiii", $order_id, $product_id, $quantity, $product_id, $quantity);
        $stmt->execute();
        $stmt->close();
        
        $success = "Order placed successfully!";
    } else {
        $error = "Customer not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../templates/customer_header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Place Order</h2>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="place_order.php" method="post">
            <div class="form-group">
                <label for="name">Enter Your Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="product_id">Select Product:</label>
                <select class="form-control" id="product_id" name="product_id" required>
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo $product['P_ID']; ?>"><?php echo $product['P_Name']; ?> - <?php echo $product['Price']; ?> PKR</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="delivery_method">Delivery Method:</label>
                <select class="form-control" id="delivery_method" name="delivery_method" required>
                    <option value="Delivery">Delivery</option>
                    <option value="Pickup">Pickup</option>
                </select>
            </div>
            <div class="form-group">
                <label for="delivery_address">Delivery Address:</label>
                <input type="text" class="form-control" id="delivery_address" name="delivery_address" required>
            </div>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>

    <?php include '../templates/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
