<?php
    session_start();

    if(isset($_SESSION["user"])){
        header("location: home.php");
    }

    if(isset($_SESSION["adm"])){
        header("Location: dashboard.php");
    }

    if(isset($_SESSION["superA"])){
        header("Location: super.php");
    }

    require_once "actions/db_connect.php";
    $error = false;
    $email = "";
    $passwordError = $emailError = "";

    if(isset($_POST["submit"])){
     

        $email = trim($_POST["email"]);  
        $email = strip_tags($email); 
        $email = htmlspecialchars($email);

        $password = trim($_POST["password"]); 


        if(empty($email)){
            $error = true;
            $emailError = "Please type your email";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = true;
            $emailError = "Please type a valid email";
        }


        if(empty($password)){
            $error = true;
            $passwordError = "Please Type your password";
        }

        if(!$error){
            $password = hash("sha256", $password); 

            $sql = "SELECT * FROM users WHERE email= '$email' AND password = '$password'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $count = mysqli_num_rows($result);

            if($count == 1){
                if($data["status"] == "user"){
                    $_SESSION["user"] = $data["id"];
                    header("location: home.php");
                }else {
                    $_SESSION["adm"]= $data["id"];
                    header("Location: dashboard.php");
                }
            }else {
                echo "something went wrong, check your credentials";
            }
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "components/bootstrap.php"; ?>
    <title>Login</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <h1 class="navbar-brand">Animals-World</h1> 
    </div>
  </div>
</nav>

    <div class="mt-5 mx-5">
        <img src="image/dog.jpg" class="img-fluid" alt="..."> 
    </div>
   
<div class="container mt-5">
        <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
            <input type="email" name="email" class="form-control" placeholder="Enter Your email" maxlength="40" value="<?php echo $email ?>" />
            <span class="text-danger"> <?php echo $emailError; ?> </span><br>
            
            <input type="password" name="password" class="form-control" placeholder="Enter password" maxlength="15" />
            <span class="text-danger"> <?php echo $passwordError; ?> </span><br>
            <hr />
            <button type="submit" class="btn btn-block btn-dark" name="submit">Login</button>
            <hr />
            <div class="mb-5">
                 <h2>If you don't have an Account</h2>
            <a href="register.php">SignUp Now</a>
            </div>
           
        </form>
    </div>
  
</form>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>