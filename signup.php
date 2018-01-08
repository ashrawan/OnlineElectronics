<?php include("includes/header.php"); ?>


<?php 

$var=0;
$errors=array();
$fname=$lname=$email=$add=$ph=$username=$p1=$p1="";

if(isset($_POST['register'])) {

  $firstname=clean($_POST['fname']);
  $lastname=clean($_POST['lname']);
  $username=clean($_POST['username']);
  $email=clean($_POST['email']);
  $phone=clean($_POST['ph']);
  $address=clean($_POST['add']);
  $p1=($_POST['p1']);
  $p2=($_POST['p2']);

    if(empty($firstname)){
      $errors[0]="Firstname is required";
    }
    else if(!ctype_alpha($firstname)) {
      $errors[0]="Invalid characters ";
    }
    else if(strlen($firstname)>20) {
      $errors[0]="Too long firstname";
    }


    if(empty($lastname)){
      $errors[1]="Lastname is required";
    }
    else if(!ctype_alpha($lastname)){
      $errors[1]="Invalid characters ";
    }
     else if(strlen($lastname)>20) {
      $errors[1]="Too long lastname";
    }


      if(empty($username)){
      $errors[2]="Username is required";
    }
     else if(strlen($lastname)>10) {
      $errors[2]="username too long";
    }

    
    if(empty($p1)){
      $errors['p1']="password is required";
    }
     else if(strlen($p1)<5) {
      $errors['p1']="password too short";
    }

    if(empty($p2)){
      $errors['p2']="password is required";
    }
     else if(strlen($p2)<5) {
      $errors['p2']="password too short";
    }
    if($p1!==$p2){
      $errors['p1']="password mismatched";
    }

    if(empty($email)){
      $errors[3]="Email is required";
    }

     if(empty($address)){
      $errors[5]="address is required";
    }

    if(empty($phone)){
      $errors[4]="Phone no. is required";
    }


  if(count($errors)==0){
     register();
  }
}


?>


<div class="col-lg-6 col-lg-offset-3 regbox">

 <h4 class="text-center"> Register as New User</h4> 
 
 <form class="form-horizontal" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="firstname" class="control-label col-sm-3">First Name:</label>
		<div class="col-sm-9">
			<input type="text" placeholder="Your first name" class="form-control" name="fname" value="<?php if(isset($firstname)) echo $firstname; ?>">
			<span class="error"><?php if(isset($errors[0])) echo $errors[0]; ?></span>
		</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="control-label col-sm-3">Last Name:</label>
		<div class="col-sm-9">
			<input type="text" placeholder="Your last name" class="form-control" name="lname" value="<?php if(isset($lastname)) echo $lastname; ?>">
			<span class="error"><?php if(isset($errors[1])) echo $errors[1]; ?></span>
		</div>
		</div>
	
	

		<div class="form-group">

			<label for="username" class="control-label col-sm-3">Username</label>
			<div class="col-sm-9">	
			<input type="text" placeholder="Choose Username" class="form-control" name="username" value="<?php if(isset($username)) echo $username; ?>"> 
			<span class="error"><?php if(isset($errors[2])) echo $errors[2]; ?></span>
			</div>
		</div>



		<div class="form-group">
			<label for="email" class="control-label col-sm-3">Email address:</label>
			<div class="col-sm-9">
			<input type="email" placeholder="Enter email" class="form-control" id="email" name="email" value="<?php if(isset($email)) echo $email; ?>"> 
			<span class="error"><?php if(isset($errors[3])) echo $errors[3]; ?></span>
			</div>
		</div>


    <div class="form-group">
      <label class="control-label col-sm-3">Phone no.:</label>
      <div class="col-sm-9">
      <input type="number" placeholder="Enter Phone number" class="form-control" id="ph" name="ph" value="<?php if(isset($phone)) echo $phone; ?>"> 
      <span class="error"><?php if(isset($errors[4])) echo $errors[4]; ?></span>
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-3">Location / Address:</label>
      <div class="col-sm-9">
      <input type="text" placeholder="Enter address" class="form-control" id="address" name="add" value="<?php if(isset($address)) echo $address; ?>"> 
      <span class="error"><?php if(isset($errors[5])) echo $errors[5]; ?></span>
      </div>
    </div>


		<div class="form-group">
			<label for="pwd" class="control-label col-sm-3">Password:</label>
			<div class="col-sm-9">
			<input type="password" class="form-control" name="p1" value="<?php if(isset($p1)) echo $p1; ?>">
			<span class="error"> <?php if(isset($errors['p1'])) echo $errors['p1']; ?></span>
			</div>
		</div>

		<div class="form-group">
			<label for="pwd" class="control-label col-sm-3">Password:</label>
			<div class="col-sm-9">
			<input type="password" class="form-control" name="p2" value="<?php if(isset($p2)) echo $p2; ?>">
			</label> <span class="error"> <?php if(isset($errors['p2'])) echo $errors['p2']; ?></span>
			</div>
		</div>


		<div class="col-sm-offset-0">
		<button type="submit" name="register" class="btn btn-primary btn-lg btn-block"> Submit </button> 
		</div>

</form>
</div>


<?php include("includes/footer.php"); ?>