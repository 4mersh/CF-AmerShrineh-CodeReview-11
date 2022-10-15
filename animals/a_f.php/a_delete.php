<?php 
require_once '../../actions/db_connect.php';

session_start();


if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: ../../login.php");
}
if(isset($_SESSION["user"])){
    header("Location: ../../home.php");
}

if ($_POST) {
    $id = $_POST['id'];
    $image = $_POST['id'];
    ($image =="image/dog.jpg");

    $sql = "DELETE FROM animals WHERE id = {$id}";
    if (mysqli_query($conn, $sql) === TRUE) {
        $class = "success";
        $message = "Successfully Deleted!";
    } else {
        $class = "danger";
        $message = "The entry was not deleted due to: <br>" . $conn->error;
    }
    mysqli_close($conn);
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete</title>
        <?php require_once '../../components/bootstrap.php'?>  
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Delete request response</h1>
            </div>
            <div class="alert alert-<?=$class;?>" role="alert">
                <p><?=$message;?></p>
                <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>
        </div>
    </body>
</html>