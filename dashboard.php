<?php
    session_start();
    require_once "actions/db_connect.php";

    if(!isset($_SESSION["adm"]) && !isset($_SESSION["user"]) && !isset($_SESSION["superA"])){
        header("Location: login.php");
    }

    if(isset($_SESSION["user"])){
        header("Location: home.php");
    }

    if(isset($_SESSION["superA"])){
      header("Location: super.php");
  }

    $sql = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";

    $result = mysqli_query($conn, $sql);

    $data = mysqli_fetch_assoc($result);
    
    $sql2 = "SELECT * FROM users WHERE status = 'user'";
    $result2 = mysqli_query($conn, $sql2);

    $text = "";

    while($row = mysqli_fetch_assoc($result2)){
        $text.= "<p>{$row["fname"]} {$row["lname"]} |  <a href='update.php?id={$row["id"]}'>Update</a> / <a href='delete.php?id={$row["id"]}'>Delete</a></p>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
          <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="usersInfo.php">Users_Info</a>
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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Animals_Setting
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="animals/create.php?create">Create</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="animals/index.php?index">Index</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<div class="mt-5 mx-5">
        <img src="image/dog.jpg" class="img-fluid" alt="..."> 
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>