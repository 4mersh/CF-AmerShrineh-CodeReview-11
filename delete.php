<?php 

require_once "actions/db_connect.php";

session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["superA"])){
    header("location: login.php");
}

if(isset($_SESSION["user"])){
    header("location: home.php");
}

$id = $_GET["id"];
$sql = "DELETE FROM users WHERE id = {$id}";

$result = mysqli_query($conn, $sql);
 header("location: usersInfo.php");

?>