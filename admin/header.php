

<?php	require_once("../includes/functions.php"); ?>

<?php if(isset($_SESSION['username'])){ if(($_SESSION['username']!=='admin')){
  header("location:no.php");}}
  if(!isset($_SESSION['username'])){header("location:no.php");}
  ?>

 <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Customcss -->
    <link href="../stylesheets/a.css" rel="stylesheet">
    <link href="../stylesheets/admin.css" rel="stylesheet">

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php"><img src="../images/logo.png" class="img-responsive adimg"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav menu">
         <li><a href='allorders.php'> All Users Order </a></li>
         <li><a href='allitems.php'> All Items </a></li>
         <li><a href='users_data.php'> All Registered Users </a></li>
         <li><a href='insertitem.php'> Add new Items </a></li>
        </ul>


<?php 
if(isset($_POST['logout'])) {
  header("location:../index.php"); 
    session_unset(); 
    session_destroy(); 

  }
?>


<form method="post" enctype="multipart/form-data" action="">
	 <ul class="nav navbar-nav navbar-right n">
	    <li><button class="btn btn-default logoutbtn" type="submit" name="logout"><span class="glyphicon glyphicon-log-in"></span> Logout </button></li>
	  </ul>

</form>


</div>
  </div>
</nav>


<div class="container cont">