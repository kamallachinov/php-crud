<?php
// Database connection parameters (assuming you're using the same connection details)
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

// Update logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Escape user inputs for security
    $id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);

    // Fetch the row from the database
    $sql_select = "SELECT name FROM `crud-test` WHERE `id`=$id";
    $result = $conn->query($sql_select);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $row_name = $row['name'];
        

        // Compare the submitted input value with the value from the database
        if ($name !== $row_name) {
            // Update the record
            $sql_update = "UPDATE `crud-test` SET `name`='$name' WHERE `id`=$id";
            if ($conn->query($sql_update) === TRUE) {
                echo "<script>window.history.back();
                alert('Record updated successfully')</script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "<script>alert('No changes made.');
            window.history.back();
            </script>";
        }
    } else {
        echo "No record found for the given ID";
    }
}

// Close connection
$conn->close();