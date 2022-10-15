<?php
    session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: ../login.php");
    }
    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
    }

    require_once "../actions/db_connect.php";

    $sql = "SELECT * FROM `animals`";
    $result = mysqli_query($conn, $sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../components/bootstrap.php"; ?>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Animals-World</a>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../dashboard.php">Home</a>
        </li>
    </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
<fieldset>
            <legend class='h2'>Add item</legend>
            <form action="a_f.php/a_create.php" method= "post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="name"  placeholder="Animal Name" /></td>
                    </tr>    
                    <tr>
                        <th>Address</th>
                        <td><input class='form-control' type="text" name= "address" placeholder="address" step="any" /></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><input class='form-control' type="text" name= "age"step="any" /></td>
                    </tr>
                    <tr>
                        <th>Hobbies</th>
                        <td><input class='form-control' type="text" name= "hobbies" placeholder="hobbies" step="any" /></td>
                    </tr>
                    
                    <tr>
                        <th>Description</th>
                        <td><input class='form-control' type="text" name= "description" placeholder="description" step="any" /></td>
                    </tr>
                    <tr>
                        <th>image</th>
                        <td><input class='form-control' type="file" name="image" /></td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td>    
                   <select name="size" id="size" class='form-control'>
            <option value="">NULL</option>
            <option value="large">large</option>
            <option value="small">small</option>
            <option value="senior">senior</option>
            </select>
                        </td>
                        
                    </tr>
                    <tr>
                        <td><button class='btn btn-dark' type="submit">Insert item</button></td>
                        <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </div>
</body>
</html>