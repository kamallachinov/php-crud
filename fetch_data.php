<?php
// Database connection 
include 'connect.php';

// Fetch data from the database
$sql = "SELECT * FROM `crud-test`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>";
        echo "<input type='text' class='form-control' value='" . $row["name"] . "' />";
        echo "</td>";
        echo "<td>";
        echo "<div class='btn-group'>";
        echo "<form action='update_data.php' method='POST'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
        echo "<input type='hidden' name='name' value='" . $row["name"] . "'>";
        echo "<button type='submit' class='btn btn-primary' name='update'>Update</button>";
        echo "</form>";
        echo "<form action='delete.php' method='POST' onsubmit='return confirmDelete();'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
        echo "<button type='submit' class='btn btn-danger ml-2' name='delete'>Delete</button>";
        echo "</form>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr>
    <td colspan='3'>No records found</td>
</tr>";
}
// Close connection
$conn->close();
?>

<!-- Add a JavaScript function for confirmation -->
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this record?');
    }
</script>