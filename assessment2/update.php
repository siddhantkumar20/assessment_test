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

    $sql = "SELECT * FROM information WHERE id= '$id'";
    $result = $conn->query($sql);
          
    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
    }
}

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        if(isset($_GET['id_new'])){
            $idnew = $_GET['id_new'];
        }
        $first_n = htmlspecialchars($_POST['first_name']);
        $last_n = htmlspecialchars($_POST['last_name']);
        $do = htmlspecialchars($_POST['dob']);
        $emai = htmlspecialchars($_POST['email']);
    
        $stmt = $conn->prepare("UPDATE information SET first_name=? , last_name=? , dob=?, email=?  WHERE id=?");
        $stmt->bind_param('sssss', $first_n, $last_n, $do, $emai, $idnew);
        $stmt->execute();


        if($stmt->errno) {
            die("Execute failed: ".$stmt->error);
        }else
        {
            echo "Success";
        }
        $stmt->close();

        header("location:assessment2.php");
    }

?>

<form action="<?php echo $_SERVER['PHP_SELF'];  ?>?id_new=<?php echo $id; ?>" method="POST">
<label for="first_name">First Name:</label>
<input type="text" name="first_name" value="<?php echo $row["first_name"]; ?>" required>
<br>
<label for="last_name" >Last Name:</label>
<input type="text" name="last_name" value="<?php echo $row["last_name"]; ?>" required>
<br>
<label for="dob" >DoB:</label>
<input type="date" name="dob" value="<?php echo $row["dob"]; ?>" required>
<br>
<label for="email" >Email:</label>
<input type="text" name="email" value="<?php echo $row["email"]; ?>" required>
<input type="submit" value="Submit">

</form>