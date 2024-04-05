<?php
// Database connection 
include 'connect.php'; //  database connection 

// Check if the ID parameter is set in the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Check if the ID is provided in the POST data
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Prepare SQL statement to delete record with the given ID
        $sql = "DELETE FROM `crud-test` WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id); // "i" indicates integer type 
        // for preventing sql injection
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Redirect back to the page where the delete button was clicked
            header("Location: {$_SERVER['HTTP_REFERER']}");
            echo "<script>alert('Deleted!')</script>";
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "ID not provided.";
    }
}

// Close connection
$conn->close();
