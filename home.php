<?php

    session_start();

    require_once "actions/db_connect.php";

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["superA"])){
        header("Location: login.php");
    }

    if(isset($_SESSION["superA"])){
      header("Location: super.php");
  }

    if(isset($_SESSION["adm"])){
        header("Location: dashboard.php");
        exit;
    }

    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    $sql1 = "SELECT * FROM `adopt` ";
    $result1 = mysqli_query($conn, $sql);

    $data1 = mysqli_fetch_assoc($result1);
    
    $sql = "SELECT * FROM animals";
    $result = mysqli_query($conn, $sql);

    $body = "";

    if(mysqli_num_rows($result) == 0){
        $body = "<div class='text-center h1 text-danger'>No Result</div>";
    }else {
        while($row = mysqli_fetch_assoc($result)){
            $body.= "
            <div class='card mb-3' style='max-width: 540px;'>
  <div class='row g-0'>
    <div class='col-md-4'>
      <img src='../image/{$row["image"]}' class='img-fluid rounded-start' alt='{$row["name"]}'>
    </div>
    <div class='col-md-8'>
      <div class='card-body'>
        <h5 class='card-title'>{$row["name"]}</h5>
        <p class='card-text'>{$row["address"]}.</p>
        <p class='card-date'>{$row["age"]}</p>
        <p class='card-date'>{$row["hobbies"]}</p>
        <p class='card-date'>{$row["description"]}</p>
        <p class='card-date'>{$row["size"]}</p>
        <a href='GET.php?id={$row["id"]}'class='btn btn-danger'>Adopt</a>
      </div>
    </div>
  </div>
</div>
            ";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <?php require_once "components/bootstrap.php"; ?>
    <title>Hello <?= $data["fname"] ?></title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Animals-World</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="senior.php">Senior Animals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="general.php">Young Animals</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Settings
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="update.php?id=<?= $data["id"] ?>">Update Account</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php?logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
<div class="text-center mt-5">
  <h1>Search</h1>
</div>
  <div class="row">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="search">
      <table class="table table-hover">
      <thead>
        <tr>
          <th>name</th>
          <th>description</th>
          <th>hobbies</th>
          <th>size</th>
          <th>image</th>
        </tr>
      </thead>

      <div class="mt-5 mx-5">
        <img src="image/dog.jpg" class="img-fluid" alt="..."> 
    </div>

      <tbody id="output">
      </tbody>
    </table>
    </div>
    <div class="col-sm-3">
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#search").keypress(function(){
      $.ajax({
        type:'POST',
        url:'search2.php',
        data:{
          name:$("#search").val(),
        },
        success:function(data){
          $("#output").html(data);
        }
      });
    });
  });
</script>

<div class="container mt-5 mb-5">
  <div class="row row-cols-4 mt-5 x-grid gap-3">
           <?= $body;?> 
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>