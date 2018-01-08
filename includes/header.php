<?php require_once("functions.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <title> Online Electronics </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Customcss -->
    <link href="stylesheets/a.css" rel="stylesheet">

    <script src="javascript/jquery-3.1.0.js"></script>

    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap/font-awesome-4.7.0/css/font-awesome.min.css">



  </head>
  <body>


<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="img-responsive logo"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav menu">
         <li><a href="home.php">Home</a></li>
         <li><a href="order.php">Order</a></li>
         <li><a href="contact.php">Contact</a></li>
        </ul>


<?php 
  $lusername=$lpassword="";
  if(isset($_POST['login'])) {
     $lusername=($_POST['lusername']);
     $lpassword=($_POST['lpassword']);
     login();
  }

  if(isset($_POST['logout'])) {
  header("location:index.php"); 
    session_unset(); 
    session_destroy(); 

  }

?>

<?php
  if(isset($_SESSION['username'])) {
    include("userview.php");
  }  
  else {
  include("logging.php"); 
  }
?>
     
    </div>
  </div>
</nav>


<div class="container-fluid cont">