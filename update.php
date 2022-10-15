<?php

session_start();

require_once "actions/db_connect.php";

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["superA"])){
    header("location: login.php");
}

$id = $_GET["id"];
$sql = "SELECT * FROM users WHERE id = {$id}";

$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);


    if(isset($_POST["submit"])){
        $id = $_POST["id"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];


        $sql = "UPDATE `users` SET `fname`='$fname',`lname`='$lname',`email`='$email',`dateOfBirth`='$dateOfBirth' WHERE id = {$id}";
        $result = mysqli_query($conn, $sql);
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "components/bootstrap.php"; ?>
    <title>Update</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Animals-World</a>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
    </ul>
    </div>
  </div>
</nav>

<div class="mt-5 mx-5">
        <img src="image/dog.jpg" class="img-fluid" alt="..."> 
    </div>

<div class="container mt-5 mb-5">

<form method="post">

<input type="text" name="fname" class="form-control" placeholder="First name" maxlength="50" value="<?= $data["fname"] ?>">
        <span class="text-danger"></span><br>

        <input type="text" name="lname" class="form-control" placeholder="Surname" maxlength="50" value="<?= $data["lname"]?>" >
        <span class="text-danger"></span><br>

        <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?= $data["email"] ?>" >
        <span class="text-danger"></span><br>
        
        <input type="hidden" name="id" class="form-control"  maxlength="40" value="<?= $data["id"] ?>">
        <span class="text-danger"></span><br>
        
            <hr>
                <button type="submit" class="btn btn-block btn-dark" name="submit">Update</button>
                <hr>
        
        
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>