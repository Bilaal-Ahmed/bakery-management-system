<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_supplier'])) {
    $s_name = $_POST['s_name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $address = $_POST['supplier_type'];

    $query = "INSERT INTO supplier (S_Name, Phone, Email, Address, Supplier_Type) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $s_name, $contact, $email, $address, $supplier_type);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Suppliers</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../admin/admin_header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Manage Suppliers</h2>
        <form action="manage_suppliers.php" method="post" class="mt-3">
            <input type="hidden" name="add_supplier" value="1">
            <div class="form-group">
                <label for="s_name">Supplier Name:</label>
                <input type="text" class="form-control" id="s_name" name="s_name" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="supplier_type">Supplier_Type:</label>
                <input type="text" class="form-control" id="supplier_type" name="supplier_type" required>
            </div>
            <button type="submit" class="btn btn-success">Add Supplier</button>
        </form>

        <hr>

        <h3 class="text-center mt-5">Supplier List</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Supplier Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM supplier";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['S_ID']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['Phone']}</td>
                        <td>{$row['Email']}</td>
                        <td>{$row['Address']}</td>
                        <td>{$row['Supplier_Type']}</td>
                        <td>
                            <a href='edit_supplier.php?id={$row['S_ID']}' class='btn btn-primary btn-sm'>Edit</a>
                            <a href='delete_supplier.php?id={$row['S_ID']}' class='btn btn-danger btn-sm'>Delete</a>
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
