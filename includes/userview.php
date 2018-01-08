

<form method="post" enctype="multipart/form-data" action="">
	 <ul class="nav navbar-nav navbar-right n menu">

	 <li><a href="viewcart.php"> View Cart <span class="badge"> <?php if(isset($_SESSION['citems'])) echo count($_SESSION['citems']); else echo "0"; ?> </span> </a></li>
	 		
	 	<li><label class="welcome-message"><span class="h4"><h4> <?php  echo "Welcome ". $_SESSION['username']; ?></h4></span> </label></li>
        <li><button class="btn btn-default logoutbtn" type="submit" name="logout"><span class="glyphicon glyphicon-log-in"></span> Logout </button></li>
      </ul>

</form>

	