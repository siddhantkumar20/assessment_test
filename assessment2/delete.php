<?php

$servername = "localhost";
$username = "root";
$password = null;
$database = "assessment2";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the db exists
if (!$conn->select_db($database)) {

    // create the database
    $sql = "CREATE DATABASE $database";

    if ($conn->query($sql) === TRUE) {

        // Retry Connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Creating table "Information"
        $sql = "CREATE TABLE information(
            id INT(6) PRIMARY KEY AUTO_INCREMENT,
            first_name VARCHAR(20) NOT NULL,
            last_name VARCHAR(20) NOT NULL,
            dob DATE NOT NULL,
            email VARCHAR(40)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table created successfully <br>";
        } else {
            echo "Error occurred: " . $conn->error;
        }
    } else {
        echo "Error occurred: " . $conn->error;
    }
}

// Close the initial connection
$conn->close();

// new connection to db
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM information WHERE id='$id'";
    $result = $conn->query($sql);
    header("location:assessment2.php");
}


?>