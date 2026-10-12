<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $p_name = $_POST['p_name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $product_type = $_POST['product_type'];
    $ingredients = $_POST['ingredients'];

    $query = "INSERT INTO product (P_Name, Description, Category, Quantity, Price, Product_Type, Ingredients) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssisss", $p_name, $description, $category, $quantity, $price, $product_type, $ingredients);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../admin/admin_header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Manage Products</h2>
        <form action="manage_products.php" method="post" class="mt-3">
            <input type="hidden" name="add_product" value="1">
            <div class="form-group">
                <label for="p_name">Product Name:</label>
                <input type="text" class="form-control" id="p_name" name="p_name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="product_type">Product Type:</label>
                <input type="text" class="form-control" id="product_type" name="product_type" required>
            </div>
            <div class="form-group">
                <label for="ingredients">Ingredients:</label>
                <input type="text" class="form-control" id="ingredients" name="ingredients" required>
            </div>
            <button type="submit" class="btn btn-success">Add Product</button>
        </form>

        <hr>

        <h3 class="text-center mt-5">Product List</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Ingredients</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM product";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['P_ID']}</td>
                        <td>{$row['P_Name']}</td>
                        <td>{$row['Description']}</td>
                        <td>{$row['Category']}</td>
                        <td>{$row['Quantity']}</td>
                        <td>{$row['Price']}</td>
                        <td>{$row['Product_Type']}</td>
                        <td>{$row['Ingredients']}</td>
                        <td>
                            <a href='edit_product.php?id={$row['P_ID']}' class='btn btn-primary btn-sm'>Edit</a>
                            <a href='delete_product.php?id={$row['P_ID']}' class='btn btn-danger btn-sm'>Delete</a>
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
