<?php 

require_once "actions/db_connect.php";

$sql = "SELECT * From adopt join users on users.id = adopt.fk_users join animals on animals.id = adopt.fk_animals";
$result = mysqli_query($conn ,$sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'components/bootstrap.php'?>
    <title>Document</title>
</head>
<body>
    <div class="container">

    <div class="manageProduct w-75 mt-3">    
            <p class='h2'>Adopt</p>
            <table class='table table-striped'>
                <thead class='table-success'>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Animal Name</th>
                        
                    </tr>
                    <?php
                    if(mysqli_num_rows($result) > 0) {

                        while($row = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td> <?php echo $row["fame"] ?> </td>
                                <td> <?php echo $row["lame"] ?> </td>
                                <td> <?php echo $row["name"] ?> </td>
                            </tr>
                            
                            <?php
                        }
                    }
                    
                    ?>
                </thead>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>

