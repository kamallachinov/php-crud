<?php
// Database connection 
include 'connect.php';

// Fetching data from db
$sql = "SELECT * FROM `crud-test`";
$result = $conn->query($sql);

$rows = array();
if ($result->num_rows > 0) {
    // Outputed data for each row
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
} else {
    // No data found
    $rows[] = array("id" => "<div>No item</div>", "name" => "No item", "actions" => "<div>No actions</div>");
}

// Closing connection
$conn->close();

// Convert data to JSON and echo it

echo json_encode($rows);
