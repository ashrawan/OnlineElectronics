<?php include("includes/functions.php");?>  

<?php 

if(isset($_SESSION['citems'])){
	unset($_SESSION['citems']);
	echo "sucess";
}

header("location:viewcart.php");

?>