<?php

$servername = "localhost";
$username = "root";
$password = null;
$database = "assessment2";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error)
{
    die("Connection Error".$conn->connect_error);
}


// Creating database "Assessment 2"
/*
$sql = "CREATE DATABASE assessment2";
if($conn->query($sql) == TRUE)
{
    echo "Database created successfully <br>";
}
else
{
    echo "Error occured" .$conn->error;
}
*/


// Creating table "Information"
/*
$sql = "CREATE TABLE information(
    id INT(6) PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    email VARCHAR(40)
    )";

if($conn->query($sql) === TRUE){
    echo "Table created successfully <br>";
}
else
{
    echo "Error occured " .$conn->error;
}
*/


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $dob = htmlspecialchars($_POST['dob']);
    $email = htmlspecialchars($_POST['email']);

    $stmt = $conn->prepare("INSERT INTO information (first_name, last_name, dob, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $dob, $email);

    // Execute the statement
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Crud Application</title>
</head>
<body>
    <h2>Crud Application</h2>

    <div class="container">
        <table class="table table-bordered table-striped">
            <thead style="background-color: burlywood;">
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Email</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                <?php
                
                $sql = "SELECT * FROM information";
                $result = $conn->query($sql);
                
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc()){
                    ?>                
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["first_name"] ?></td>
                    <td><?php echo $row["last_name"] ?></td>
                    <td><?php echo $row["dob"] ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><a href="update.php?id=<?php echo $row["id"]; ?>" class="btn btn-warning">Update</a></td>
                    <td><a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a></td>
                </tr>

                <?php 
                    }
                }
                ?>

            </tbody>
        </table>



<!-- Add Information -->

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Information
</button>

<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <label for="first_name">First Name:</label>
<input type="text" name="first_name" required>
<br>
<label for="last_name">Last Name:</label>
<input type="text" name="last_name" required>
<br>
<label for="dob">DoB:</label>
<input type="date" name="dob" required>
<br>
<label for="email">Email:</label>
<input type="text" name="email" required>
<br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" value="Submit">
      </div>
    </div>
  </div>
</div>
</form>

<?php

$conn->close();

?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>