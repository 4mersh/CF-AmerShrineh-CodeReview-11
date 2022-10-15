<?php
 session_start();

 if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["superA"])){
     header("Location: login.php");
 }elseif(isset($_SESSION["user"])){
     header("Location: home.php");
 }elseif(isset($_SESSION["adm"])){
     header("Location: dashboard.php");
 }elseif(isset($_SESSION["superA"])){
    header("Location: super.php");
}

 if(isset($_GET["logout"])){
     unset($_SESSION["user"]);
     unset($_SESSION["adm"]);

     session_unset();
     session_destroy();

     header("Location: login.php");
 }