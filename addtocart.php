<?php include("includes/functions.php");?>  


<?php

// Checking wheather SESSION array is set or not //
if(!isset($_SESSION['citems'])) {
	$_SESSION['citems']=array();
}


// Retriving item id and name to add to the cart //
$id=$_GET["id"];
$name=$_GET["name"];


// Checking wheather the selected item is already added to the cart or not // 
foreach ($_SESSION['citems'] as $key => $value) {
	if($value['itemid']==$id){
		echo "alert('key exists')";
		header("location: order.php");
		exit();
	}
}

// Adding the item to the SESSION['citems'] array //
	array_push($_SESSION['citems'], array('itemid'=>$id,'name'=>$name,'quantity'=>1));

	echo "alert('Item added to the cart')";


header("location: order.php");

?>