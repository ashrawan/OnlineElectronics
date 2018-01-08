
<?php include("../includes/functions.php");?>  

<?php

global $connection;

if(!empty($_GET['id'])){
	$id=$_GET["id"]; 
}
if(!empty($_GET['userid'])){	
	$uid=$_GET["userid"]; 
}

if(!empty($id)) {
$query="DELETE From products where product_id='$id' ";
$result = mysqli_query($connection,$query);
if(!$result) {
	die(mysqli_error($connection));
}
	header("location:allitems.php");
}

if(!empty($uid)) {
$query="DELETE From users_data where user_id='$uid' ";
$result = mysqli_query($connection,$query);
if(!$result) {
	die(mysqli_error($connection));
}

	header("location:users_data.php");
}

?>