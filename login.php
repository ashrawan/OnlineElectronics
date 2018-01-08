  
<?php include("includes/header.php"); ?>



<?php
$lmessage="";

if(isset($_POST['log'])) {
    $lerrors=array();

   $lusername=clean($_POST['lusername']);
   $lpassword=clean($_POST['lpassword']);
   if(empty($lusername)){
    $lerrors[0]="username is required";
    }
    if(empty($lpassword)){
    $lerrors[1]="password is required";
    }
    if(count($lerrors)==0) {
    $m=login();
    $lmessage=$m;
  }
}

?>



<div class="col-lg-6 col-lg-offset-3 regbox">


<div class="text-center">
 <h3> User Login </h3> 
  <span class="error"> <?php echo $lmessage; ?> </span>
 </div>

 <form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="username" class="control-label col-sm-3">Username:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" placeholder="Your username" name="lusername" value="<?php if(isset($lusername)) echo $lusername; ?>">
      <span class="error"><?php if(isset($lerrors[0])) echo $lerrors[0]; ?></span>
    </div>
    </div>

<div class="form-group">
      <label for="password" class="control-label col-sm-3">Password:</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" placeholder="Your password" name="lpassword">
      <span class="error"><?php if(isset($lerrors[1])) echo $lerrors[1]; ?></span>
    </div>
    </div>

    <button type="submit" name="log" class="btn btn-primary btn-lg btn-block"> Login </button> 

<p></p>
<div class="text-center">Not a Member yet! <a href='signup.php' class='btn btn-success text-center'> Sign Up </a> </div>
  </form>
</div>







  <?php include("includes/footer.php"); ?>