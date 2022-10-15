<?php 
    require_once "../actions/db_connect.php";

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
        <a href='update.php?id={$row["id"]}' class='btn btn-primary'>Update</a>
        <a href='delete.php?id={$row["id"]}' class='btn btn-danger'>Delete</a>
        
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP CRUD</title>
        <?php require_once '../components/bootstrap.php'?>
        <style type="text/css">
            .manageProduct {           
                margin: auto;
            }
            .img-thumbnail {
                width: 70px !important;
                height: 70px !important;
            }
            td {          
                text-align: left;
                vertical-align: middle;
            }
            tr {
                text-align: center;
            }
        </style>
    </head>
    <body>    <div class="container mt-5">
                <a href= "create.php"><button class='btn btn-primary'type="button" >Add</button></a>
                <a href= "../dashboard.php"><button class='btn btn-dark'type="button" >home</button></a>
            <hr>
            <div class="row row-cols-4 x-grid gap-3">
           <?= $body;?> 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

        </body>
</html>