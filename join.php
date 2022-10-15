<?php

session_start();

require_once "actions/db_connect.php";


   

$sql = "SELECT * From adopt join users on users.id = adopt.fk_users join animals on animals.id = adopt.fk_animals";
$result = mysqli_query($conn ,$sql);

$body=''; 
if(mysqli_num_rows($result)  > 0) {     
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){         
        $body .= "<tr>
            <td><img class='img-thumbnail' src='image/".$row['image']."'</td>
            <td>" .$row['fname']."</td>
            <td>" .$row['lname']."</td>
            <td>" .$row['name']."</td>

            <a href='delete.php?id=" .$row['id']."'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
            </tr>";
    };
} else {
    $body =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP CRUD</title>
        <?php require_once 'components/bootstrap.php'?>
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
    <body>
        <div class="manageProduct w-75 mt-3">    
            <p class='h2'>Adopt</p>
            <table class='table table-striped'>
                <thead class='table-success'>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Animal Name</th>
                        
                    </tr>
                </thead>
                <adopt>
                    <?= $body;?>
                </adopt>
            </table>
        </div>
    </body>
</html>