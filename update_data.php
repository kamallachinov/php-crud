<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "updateRecord") {
    $submitted_id = $_POST['id'];
    $submitted_name = $_POST['name'];
    // echo "Submitted ID: " . $submitted_id;
    // echo "Submitted name: " . $submitted_name;

    $stmt = $conn->prepare("SELECT *  FROM `crud-test` WHERE `id`=?");
    $stmt->bind_param("i", $submitted_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the record exists
    if ($result->num_rows > 0) {
        // Fetch the row and get the name from it
        $row = $result->fetch_assoc();
        $name_from_db = $row['name'];

        // Compare the submitted input value with the value from the database
        if ($submitted_name != $name_from_db) {
            $update_stmt = $conn->prepare("UPDATE `crud-test` SET name=? WHERE id=?");
            $update_stmt->bind_param("si", $submitted_name, $submitted_id);

            // Execute the update query
            if ($update_stmt->execute()) {
                echo 'Record updated successfully';
            } else {
                echo "Error updating record: " . $update_stmt->error;
            }
        } else {

            echo "No changes made.";
        }
    } else {
        echo "No record found for the given ID";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
