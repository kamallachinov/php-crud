<?php
include 'connect.php'; //  database connection 

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    if (!empty(trim($name))) {

        $sql = "INSERT INTO `crud-test` (`name`) VALUES ('$name')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('success');
                    window.location.href = 'http://localhost/phptest/main.php'; 
                  </script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>
            alert('Please enter a name');
            window.history.back();
          </script>";
    }
}

$conn->close();
?>