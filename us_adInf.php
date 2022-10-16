<?php

session_start();

require_once "actions/db_connect.php";

if(!isset($_SESSION["adm"]) && !isset($_SESSION["user"]) && !isset($_SESSION["superA"])){
    header("Location: login.php");
}

if(isset($_SESSION["user"])){
    header("Location: home.php");
}

if(isset($_SESSION["adm"])){
    header("Location: dashboard.php");
}

$sql = "SELECT * FROM users WHERE id = {$_SESSION["superA"]}";

$result = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($result);

$sql2 = "SELECT * FROM users WHERE status = 'user'";
    $result2 = mysqli_query($conn, $sql2);

    $text = "";

    $sql3 = "SELECT * FROM users WHERE status = 'adm'";
    $result3 = mysqli_query($conn, $sql3);

    $text1 = "";

    while($row = mysqli_fetch_assoc($result2)){
        $text.= "<td>" .$row['fname']."</td>
        <td>" .$row['lname']."</td>
        <td>  <a href='update.php?id={$row["id"]}'><button class='btn btn-primary'type='button' >Update</button></a> |  <a href='delete.php?id={$row["id"]}'><button class='btn btn-danger'type='button' >Delete</button></a></td>
       ";            
}


$text1 = "";

    while($row = mysqli_fetch_assoc($result3)){
        $text.= "<td>" .$row['fname']."</td>
        <td>" .$row['lname']."</td>
        <td>  <a href='update.php?id={$row["id"]}'><button class='btn btn-primary'type='button' >Update</button></a> |  <a href='delete.php?id={$row["id"]}'><button class='btn btn-danger'type='button' >Delete</button></a></td>
       ";
    }

   
  
  

?>
    
   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "components/bootstrap.php"; ?>
    <title>Update_Users</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Animals-World</a>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
        </li>
    </ul>
    </div>
  </div>
</nav>


<div class="container">

<div class="manageProduct w-75 mt-3">    
            <p class='h2'>Users Table</p>
            <table class='table table-striped'>
                <thead class='table-success'>
                    <tr>
                        <th>fname</th>
                        <th>lname</th> 
                    </tr>
                </thead>
                <text>
                    <?= $text;?>
                </text>
                <text>
                    <?= $text1;?>
                </text>
                
            </table>
        </div>
</div>


<style>
  body{background-color: lightgray;}
</style>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>