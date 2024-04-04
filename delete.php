<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare SQL statement to delete record with the given ID
    $sql = "DELETE FROM `crud-test` WHERE `id` = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the page where the delete button was clicked
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
        echo "<script>alert('Deleted!')</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
