<?php
session_start();
include('../db.php');

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Fetch all employees
$employees = [];
if ($stmt = $conn->prepare("SELECT * FROM employee")) {
    $stmt->execute();
    $result = $stmt->get_result();
    $employees = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Handle add, edit, and delete operations here (if needed)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="memployee">
<?php include '../admin/admin_header.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Manage Employees</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($employee['E_ID']); ?></td>
                        <td><?php echo htmlspecialchars($employee['E_Name']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Phone']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Email']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Role']); ?></td>
                        <td><?php echo htmlspecialchars($employee['E_Password']); ?></td>
                        <td>
                            <a href="edit_employee.php?id=<?php echo $employee['E_ID']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete_employee.php?id=<?php echo $employee['E_ID']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_employee.php" class="btn btn-success">Add Employee</a>
    </div>
    <?php include '../templates/footer.php'; ?>
</body>
</html>
