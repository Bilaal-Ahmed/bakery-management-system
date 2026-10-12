<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Management System 🍰</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff7e6;
            color: #5a3e36;
            text-align: center;
        }
        h1 {
            font-weight: 600;
            margin-bottom: 20px;
        }
        .container {
            background: #ffebcc;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #ff9f43;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 25px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-custom:hover {
            background-color: #ff6f00;
        }
        .icon {
            margin-right: 8px;
        }
        .row {
            margin-top: 30px;
        }
        .col-md-6 {
            padding: 15px;
        }
    </style>
</head>
<body>

    <?php include 'templates/header.php'; ?>

    <div class="container mt-5">
        <h1>Welcome to Punjab Bakery 🍞</h1>
        <p>Freshly baked happiness, just for you! 🥐🍪</p>
        <div class="row">
            <div class="col-md-6">
                <h2>Admin Login</h2>
                <a href="admin/login.php" class="btn btn-custom">
                    <span class="icon">👨‍💼</span> Admin Login
                </a>
            </div>
            <div class="col-md-6">
                <h2>Customer Login</h2>
                <a href="customer/index.php" class="btn btn-custom">
                    <span class="icon">🛍️</span> Customer Login
                </a>
            </div>
        </div>
    </div>

    <?php include 'templates/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>
