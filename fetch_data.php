<?php
// Database connection parameters
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

// Fetch data from the database
$sql = "SELECT * FROM `crud-test`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<th scope='row'>" . $row["id"] . "</th>";
        echo "<td><form action='update_data.php' method='POST' action='update.php'><input type='text' class='form-control' name='name' value='" . $row["name"] . "' ></td>";
        echo "<td>";

        echo "<input type='hidden' name='id' value='" . $row["id"] . "' >";
        echo "<input type='submit' class='btn btn-warning mr-2' value='Save' name='update'>";
        echo "<a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger'>Delete</a>";

        echo "</td>";
        echo "</form></tr>";
    }
} else {
    echo "<tr>
    <td colspan='3'>No records found</td>
    </tr>";
}

// Close connection
$conn->close();
