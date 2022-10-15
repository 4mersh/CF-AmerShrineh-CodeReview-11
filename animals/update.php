<?php
require_once '../actions/db_connect.php';
session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: ../login.php");
}
if(isset($_SESSION["user"])){
    header("Location: ../home.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = {$id}";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_array($result);
        $name = $data['name'];
        $address = $data['address'];
        $image = $data['image'];
        $age = $data['age'];
        $hobbies = $data['hobbies'];
        $description = $data['description'];
        $size = $data['size'];
    } else {
        header("location: error.php");
    }
    mysqli_close($conn);
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit</title>
        <?php require_once '../components/bootstrap.php';?>
        <style type= "text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }  
            .img-thumbnail{
                width: 70px !important;
                height: 70px !important;
            }     
        </style>
    </head>
    <body>
        <fieldset>
            <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='../image/<?php echo $image ?>' alt="<?php echo $name ?>"></legend>
            <form action="a_f.php/a_update.php"  method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td><input class="form-control" type="text" id="name"  name="name" placeholder ="Animals Name" value="<?php echo $name ?>"  /></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><input class="form-control" type= "text" id="address" name="address" step="any"  placeholder="address" value ="<?php echo $address ?>" /></td>
                    </tr>
                    <th>Age</th>
                        <td><input class="form-control" type= "text" id="age" name="age" step="any"  placeholder="age" value ="<?php echo $age ?>" /></td>
                    </tr>
                    <th>Hobbies</th>
                        <td><input class="form-control" type= "text" id="hobbies" name="hobbies" step="any"  placeholder="hobbies" value ="<?php echo $hobbies ?>" /></td>
                    </tr>
                    <th>Description</th>
                        <td><input class="form-control" type= "text" id="description" name="description" step="any"  placeholder="description" value ="<?php echo $description ?>" /></td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td><input class="form-control" type="file" id="image" name= "image" /></td>
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
                        <input type= "hidden" name= "id" placeholder="id" value= "<?php echo $data['id'] ?>" />
                        <input type= "hidden" name= "image" value= "<?php echo $data['image'] ?>" />
                        <td><button class="btn btn-success" type= "submit">Save Changes</button></td>
                        <td><a href= "index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>
</html>