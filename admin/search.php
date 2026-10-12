<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include('../db.php');

$query = $_GET['query'];

// Search employees
$employee_query = $conn->prepare("SELECT * FROM employee WHERE E_Name LIKE ? OR Email LIKE ? OR Role LIKE ?");
$search_term = "%".$query."%";
$employee_query->bind_param("sss", $search_term, $search_term, $search_term);
$employee_query->execute();
$employee_result = $employee_query->get_result();

// Search customers
$customer_query = $conn->prepare("SELECT * FROM customer WHERE C_Name LIKE ? OR C_Email LIKE  ?");
$customer_query->bind_param("ss", $search_term, $search_term);
$customer_query->execute();
$customer_result = $customer_query->get_result();

// Search products
$product_query = $conn->prepare("SELECT * FROM product WHERE P_Name LIKE ? OR Category LIKE ?");
$product_query->bind_param("ss", $search_term, $search_term);
$product_query->execute();
$product_result = $product_query->get_result();
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
    <?php include '../admin/admin_header.php'; ?>

    <div class="container mt-5">
        <h2>Search Results for "<?php echo htmlspecialchars($query); ?>"</h2>
        
        <h3>Employees</h3>
        <?php if ($employee_result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $employee_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['E_ID']; ?></td>
                            <td><?php echo $row['E_Name']; ?></td>
                            <td><?php echo $row['Email']; ?></td>
                            <td><?php echo $row['Role']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No employees found.</p>
        <?php endif; ?>

        <h3>Customers</h3>
        <?php if ($customer_result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $customer_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['C_ID']; ?></td>
                            <td><?php echo $row['C_Name']; ?></td>
                            <td><?php echo $row['C_Email']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No customers found.</p>
        <?php endif; ?>

        <h3>Products</h3>
        <?php if ($product_result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $product_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['P_ID']; ?></td>
                            <td><?php echo $row['P_Name']; ?></td>
                            <td><?php echo $row['Category']; ?></td>
                            <td><?php echo $row['Price']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>

    <?php include '../templates/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
