<?php include("includes/functions.php");?>  


<?php

if(isset($_POST['iupdate'])){
	$id=$_POST['id'];
	$quantity=$_POST['iquantity'];


	// Matching the given id with SESSION['citems'] element id // 
	foreach($_SESSION['citems'] as $key=>$value){
  		if($value['itemid']==$id){
    	$_SESSION['citems'][$key]['quantity']=$quantity;
    	echo "sucess";

  		}
	}
}

header("location:viewcart.php");


?>