<?php
include 'db.php';

$sql = file_get_contents('path/to/your/sql/file.sql');

if ($conn->multi_query($sql) === TRUE) {
    echo "Database installed successfully.";
} else {
    echo "Error installing database: " . $conn->error;
}

$conn->close();
?>
