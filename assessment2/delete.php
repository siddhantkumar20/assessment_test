<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$servername = "localhost";
$username = "root";
$password = null;
$database = "assessment6";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error)
{
    die("Connection Error".$conn->connect_error);
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM information WHERE id='$id'";
    $result = $conn->query($sql);
    header("location:assessment2.php");
}

?>