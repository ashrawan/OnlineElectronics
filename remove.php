<?php include("includes/functions.php");?>  


<?php 

	$id=$_GET["id"];

	foreach ($_SESSION['citems'] as $key => $value) {
	if($value['itemid']==$id){
		
		unset($_SESSION['citems'][$key]); 
	}
}


?>

<?php header("location:viewcart.php"); ?>