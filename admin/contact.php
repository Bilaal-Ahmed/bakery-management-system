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
    <title>Contact Us</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../admin/admin_header.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Contact Us</h2>
        <p>If you have any questions, please feel free to contact us using the information below:</p>
        <ul>
            <li>Email: ba341914@gmail.com</li>
            <li>Phone: +923187584281</li>
            <li>Address: Mianwali, Punjab, Pakistan</li>
        </ul>
        <form action="send_message.php" method="post" class="mt-3">
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
    <?php include '../templates/footer.php'; ?>
</body>
</html>
