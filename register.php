<?php
session_start(); 
if (isset($_SESSION['user']) != "") {
    header("Location: home.php"); 
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); 
}
require_once 'actions/db_connect.php';
$error = false;
$fname = $lname = $email = $dateOfBirth  = $password = '';
$fnameError = $lnameError = $emailError = $dateOfBirthError = $passwordError = '';
if (isset($_POST['submit'])) {

   
    $fname = trim($_POST['fname']);


    
    $fname = strip_tags($fname);

    
    $fname = htmlspecialchars($fname);

    $lname = trim($_POST['lname']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $dateOfBirth = trim($_POST['dateOfBirth']);
    $dateOfBirth = strip_tags($dateOfBirth);
    $dateOfBirth = htmlspecialchars($dateOfBirth);

    $password= trim($_POST['password']);
    $password= strip_tags($password);
    $password= htmlspecialchars($password);

    
    if (empty($fname) || empty($lname)) {
        $error = true;
        $fnameError = "Please enter your full name and surname";
    } else if (strlen($fname) < 3 || strlen($lname) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
        $error = true;
        $fnameError = "Name and surname must contain only letters and no spaces.";
    }

   
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
       
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
   
    if (empty($dateOfBirth)) {
        $error = true;
        $dateOfBirthError = "Please enter your date of birth.";
    }
    
    if (empty($password)) {
        $error = true;
        $passwordError = "Please enter password.";
    } else if (strlen($password) < 6) {
        $error = true;
        $passwordError = "Password must have at least 6 characters.";
    }

    
    $password = hash('sha256', $password);
    
    if (!$error) {

        $query = "INSERT INTO users(fname, lname, password, dateOfBirth, email)
                  VALUES('$fname', '$lname', '$password', '$dateOfBirth', '$email')";
        $res = mysqli_query($conn, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            $fname = $lname = $email = $dateOfBirth  = $password = '';
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "components/bootstrap.php"; ?>
    <title>RegisterNow</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Animals-World</a>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php">Login</a>
        </li>
    </ul>
    </div>
  </div>
</nav>
<style>
  body{
    background-color: lightblue;
  } 
</style>

<div class="container mt-5">
        <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
            <?php
            if (isset($errMSG)) {
            ?>
                <div class="alert alert-<?php echo $errTyp ?>">
                    <p><?php echo $errMSG; ?></p>
                </div>

            <?php
            }
            ?>

            <input type="text" name="fname" class="form-control" placeholder="First name" maxlength="50" value="<?php echo $fname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span><br>

            <input type="text" name="lname" class="form-control" placeholder="Surname" maxlength="50" value="<?php echo $lname ?>" />
            <span class="text-danger"> <?php echo $lnameError; ?> </span><br>

            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
            <span class="text-danger"> <?php echo $emailError; ?> </span><br>
            
            <input class='form-control w-50' type="date" name="dateOfBirth" value="<?php echo $dateOfBirth ?>" />
            <span class="text-danger"> <?php echo $dateOfBirthError; ?> </span><br>
            
            <input type="password" name="password" class="form-control" placeholder="Enter Password" maxlength="15" />
            <span class="text-danger"> <?php echo $passwordError; ?> </span><br>
            <hr />
            <button type="submit" class="btn btn-block btn-dark" name="submit">Sign Up</button>
            <hr />
        </form>
    </div>
</form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>