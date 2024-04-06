<?php
include 'connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && $_POST['action'] == "updateRecord") {
    // Escape user inputs for security
    $id = $_POST['id'];
    $name = $_POST['name'];

    // Prepare and bind parameters
    $stmt = $conn->prepare("SELECT name FROM `crud-test` WHERE `id`=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $row_name = $row['name'];

        // Compare the submitted input value with the value from the database
        if ($name !== $row_name) {
            // Prepare and bind parameters
            $stmt = $conn->prepare("UPDATE `crud-test` SET `name`=? WHERE `id`=?");
            $stmt->bind_param("si", $name, $id);
            if ($stmt->execute()) {
                echo "<script>window.history.back();
                alert('Record updated successfully')</script>";
                exit(); // Optional: Stop execution after redirect
            } else {
                echo "Error updating record: " . $stmt->error;
            }
        } else {
            echo "<script>alert('No changes made.');
            window.history.back();
            </script>";
            exit(); // Optional: Stop execution after alert
        }
    } else {
        echo "No record found for the given ID";
    }
}

// Close connection
$conn->close();
