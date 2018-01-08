
<?php	include("includes/header.php"); ?>

<?php 
if(!isset($_SESSION['userid'])){  
	header("location:login.php");
	exit();
}

	if(!isset($_SESSION['citems']) || (count($_SESSION['citems'])<1) ) {
	}
	else checkout();
	 ?>

<div class='tablediv table-responsive'>
    <h3 class="text-center white"> Your Latest Order</h3>
	<table class='table table-condensed tableviewcart'>
	
<?php
    $total=view_processing();
?>

</table>
</div>



<?php include("includes/footer.php"); ?>  