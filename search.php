<?php include("includes/header.php"); ?>




<form action="search.php" method="GET"> 
	<div class="input-group search pull-right">
		<input type="text" class="form-control" placeholder="Search" id="search-product" name="product"/>
		<div class="input-group-btn">
			<button class="btn btn-primary" type="submit">
				<span class="glyphicon glyphicon-search"></span>
			</button>
		</div>
	</div>
</form>


<div class="row">
	<div class="col-lg-12"></div>


	<?php

	if(isset($_GET['product']))
	{
		$product=$_GET['product'];
	}
	else{
		echo "<label class='btn btn-default btn-lg noitems'> Search field is empty </label>";
		exit();
	}


	$start=0;
	$limit=12;

	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$start=($id-1)*$limit;
	}
	else{
		$id=1;
	}

	// Display the matching product //
	$total = search_product($product,$start,$limit); 

	?>


</div>

<div class="pager_outer">
	<ul class="pager">

		<?php

		if($id>1)
		{
    //Go to previous page to show previous 10 items. If its in page 1 then it is inactive
			echo "<li><a href='?id=".($id-1)."' class='button'>PREVIOUS</a></li>";
		}


//show all the page link with page number. When click on these numbers go to particular page. 
		for($i=1;$i<=$total;$i++)
		{
			if($i==$id) { echo "<li><a href='' class='active'>". $i ."</li>"; }

			else { echo "<li><a href='?id=".$i."'>". $i ."</a></li>"; }
		}


		if($id!=$total)
		{
    ////Go to previous page to show next 10 items.
			echo "<li align='right'><a href='?id=".($id+1)."' class='button'>NEXT</a></li>";
		}

		?>

	</ul>

</div>

<?php include("includes/footer.php"); ?>