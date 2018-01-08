
<?php	include("includes/header.php"); ?>


<!-- viewcart.php, link- Back to order and info ordered list -->
<div class='row'>
	<div class='col-sm-2'>
		<a href='order.php' class='pull-left btn btn-info btn-lg'> Back to Order </a>
	</div>

	<div class='col-sm-10'>
		<button class='pull-right btn btn-default btn-block btn-lg'> The Ordered List </button>
	</div>
</div>


<table class='table  table-condensed' width='100%'>
	<tr>
		<td> 
			<!-- Checking whether there are items on cart or not -->
			<?php
				// print_r($_SESSION['citems']);
					
					if(!isset($_SESSION['citems']) || (count($_SESSION['citems'])<1) ) {
					echo "<label class='btn btn-default btn-lg noitems'> 
								There are no items  in the Cart
						</label>";
						exit (); 
					}  
			?> 
		</td>
	</tr>
</table>



<!-- Displaying item image, name, price, quantity and other info -->

<div class='tablediv table-responsive'>
	<table class='table table-condensed tableviewcart'>
		<tr>
			<th> Item Image </th> 
			<th> Item Name </th> 
			<th> Item Price </th> 
			<th> Update Quantity </th> 
			<th> Update </th>  
			<th> Tot. Price </th> 
			<th> Delete </th>
		</tr>

<?php

// Intializing total price as zero //
$totalprice=0;   

// Looping through all the items of SESSION['citems'] array //
foreach ($_SESSION['citems'] as $val) {
	$id=$val['itemid'];
	$quantity=$val['quantity'];
	$row = get_item_by_id($id);   // Retriving item details by id // 

		$id=$row['product_id'];
    	$name=$row['product_name'];
    	$price=$row['product_price'];
    	$image=$row['p_img1'];

	echo "<tr> 
			<td>
				<img class='img-responsive img-rounded img-thumbnail imgv' src='images/$image'>
			</td>
			<td> $name </td>
			<td> $price </td>";


		// Form for updating quantity, passing item id and input quantity as POST //
	echo "	<form role='form' action='updatequantity.php' method='post'>
				<td> 
					<input type='hidden' value='$id' name='id'>
					<input type='number' min='1' class='form-control' name='iquantity' value='$quantity'>
				</td>

				<td>
					<button type='submit' class='btn btn-info' name='iupdate'>Update</button>
				</td>
			</form>";

	$eachitemtotal=$price * $quantity;    // total of each item //


	// For removing each selected item, passing item id as GET //
echo "	<td> $eachitemtotal </td>
		<td> <a href='remove.php?id=$id' class='btn btn-danger'>Delete </a> </td>
	</tr> ";

	$totalprice=$price * $quantity + $totalprice;
}


echo "

<tr>
	<td colspan='1'>
		<a href='emptycart.php' class='pull-right btn btn-danger btn-block btn-lg '> Make Cart Empty </a>
	</td>
	<td colspan='2' align='right' height='40px'> 
		<h3> Total Amount <h3>  
	</td>
	<td colspan='1'>
		<h3>Rs. $totalprice </h3>
	</td>
	<td colspan='3'> 
		<a href='checkout.php' class='btn btn-success btn-lg btn-block viewcartdownbtns'> Checkout </a> 
	</td>
</tr>
";

?>

</table>
</div>


<?php include("includes/footer.php"); ?>   