<?php
require_once '../../actions/db_connect.php';
require_once 'file_upload.php';

session_start();


if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: ../../login.php");
}
if(isset($_SESSION["user"])){
    header("Location: ../../home.php");
}


if ($_POST) { 
    $id = $_POST['id'];   
    $name = $_POST['name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $hobbies = $_POST['hobbies'];
    $uploadError = '';
    $image = file_upload($_FILES['image']);
    $size = $_POST['size'];
    $sql = "UPDATE `animals` SET `name`='$name',`image`='$image->fileName',`address`='$address',`description`='$description',`hobbies`='$hobbies',`age`='$age',`size`='$size' WHERE id = {$id}";
    $result =mysqli_query($conn, $sql);}
   
   
//     if($image->error===0){
//         ($_POST["image"]=="dog.jpg")?: unlink("../../images/$_POST[image]");           
//         $sql = "UPDATE `animals` SET `name`='$name',`image`='$image->fileName',`address`='$address',`description`='$description',`hobbies`='$hobbies',`age`='$age',`size`='$size' WHERE id = {$id}";
      
//     if (mysqli_query($conn, $sql) === TRUE) {
//         $class = "success";
//         $message = "The record was successfully updated";
//         $uploadError = ($image->error !=0)? $image->ErrorMessage :'';
//     } else {
//         $class = "danger";
//         $message = "Error while updating record : <br>" . mysqli_conn_error();
//         $uploadError = ($image->error !=0)? $image->ErrorMessage :'';
//     }
// }

//     mysqli_close($conn);    
// } else {
//     header("location: ../error.php");
// }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Update</title>
        <?php require_once '../../components/bootstrap.php'?> 
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Update request response</h1>
            </div>
            <div class="alert alert-<?php echo $class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../update.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
                <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>
        </div>

       
</html>