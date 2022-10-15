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
    $name = $_POST['name'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $hobbies = $_POST['hobbies'];
    $age = $_POST['age'];
    $uploadError = '';
    $size = $_POST["size"];
    $image = file_upload($_FILES['image']); 
    

        
           $sql = "INSERT INTO `animals`(`name`, `image`, `address`, `description`, `hobbies`, `age`, `size`) VALUES ('$name','$image->fileName','$address','$description','$hobbies','$age','$size')";
        
    
        if (mysqli_query($conn, $sql) === true) {
            $class = "success";
            $message = "The entry below was successfully created <br>
                <table class='table w-50'><tr>
                <td> $name </td>
                </tr></table><hr>";
            $uploadError = ($image->error !=0)? $image->ErrorMessage :'';
        } else {
            $class = "danger";
            $message = "Error while creating record. Try again: <br>" . $conn->error;
            $uploadError = ($image->error !=0)? $image->ErrorMessage :'';
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
        <title>Update</title>
        <?php require_once '../../components/bootstrap.php'?>
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Create request response</h1>
            </div>
            <div class="alert alert-<?=$class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
            </div>
        </div>
    </body>
</html>