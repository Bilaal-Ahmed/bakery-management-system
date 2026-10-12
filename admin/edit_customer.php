<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include('../db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM customer WHERE C_ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $loyaltyPoints = $_POST['loyaltyPoints'];

    $stmt = $conn->prepare("UPDATE customer SET C_Name = ?, C_Email = ?, C_Password = ?, C_Address = ?, C_LoyaltyPoints = ? WHERE C_ID = ?");
    $stmt->bind_param("ssssii", $name, $email, $password, $address, $loyaltyPoints, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_customers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Customer</h2>
        <form action="edit_customer.php" method="post">
            <input type="hidden" name="id" value="<?php echo $customer['C_ID']; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $customer['C_Name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $customer['C_Email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $customer['C_Password']; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $customer['C_Address']; ?>" required>
            </div>
            <div class="form-group">
                <label for="loyaltyPoints">Loyalty Points:</label>
                <input type="number" class="form-control" id="loyaltyPoints" name="loyaltyPoints" value="<?php echo $customer['C_LoyaltyPoints']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Customer</button>
        </form>
    </div>
</body>
</html>
