


	<form role="form" class="form-inline" method="post" enctype="multipart/form-data" action="">
	
		
		<div class="form-group hidden-sm hidden-xs">
			<label> Username: </label>
	        <input type="text" class="form-control customsize" name="lusername" value="<?php if(isset($lusername)) echo $lusername; ?>" />
	    </div>
		
	    <div class="form-group hidden-sm hidden-xs">
	    	<label> Password: </label>
	        <input type="password" class="form-control customsize" name="lpassword" id="password" />
	    </div>

	    <div class="form-group hidden-sm hidden-xs">
	         <button class="btn btn-default login" type="submit" name="login" value="login">Login</button>
	   	</div>

	
<div class="form-group">
 <ul class="nav navbar-nav navbar-right menu">
        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
     </div>

     </form>
    