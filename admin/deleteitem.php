<?php include("../includes/functions.php");?>  

<?php

global $connection;

if(!empty($_GET['id'])){
	$id=$_GET["id"]; 
}


if(!empty($id)) {
$query="DELETE From products where product_id='$id' ";
$result = mysqli_query($connection,$query);
if(!$result) {
	die(mysqli_error($connection));
}
	header("location:allitems.php");
}


?>