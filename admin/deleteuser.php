<?php include("../includes/functions.php");?>  

<?php

if(!empty($_GET['userid'])){	
	$uid=$_GET["userid"]; 
}

if(!empty($uid)) {
$query="DELETE From users_data where user_id='$uid' and user_id <> 8 ";
$result = mysqli_query($connection,$query);
if(!$result) {
	die(mysqli_error($connection));
}
		
	header("location:users_data.php");
}

?>