
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

<!-- Order.php, top row to select a paricular item in category -->
<form role="form" class="form-horizontal" method="post"> 
	<div class="col-lg-12">
		<div class="col-sm-8">
			<div class="form-group">
				<label class="col-sm-2 btn btn-default"> Select: </label> 
				<div class="col-sm-8">
					<select class="form-control" name="selectedvalue"> 
						<option value="1">All</option>
						<?php 
						$selopt="1";
						if(isset($_POST['selectedvalue'])) $selopt = $_POST['selectedvalue'];
				displaycat($selopt);   // retriving all category for displaying select options // 
				?>
			</select> 
		</div>
		<div class="col-sm-2">
			<button class="btn btn-primary" type="submit" name="submit"> Submit </button> 
		</div>
	</div>
</div>

<div class="form-group col-sm-4">

	<a href="viewcart.php" class="pull-right btn btn-info"> View Cart <span class="badge"> <?php if(isset($_SESSION['citems'])) echo count($_SESSION['citems']); else echo "0"; ?> </span> </a>
</div>
</div>
</form>


<div class="row">
	<div class="col-lg-12"></div>

	<?php 



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

	// Display all the items //
	if($selopt==1) $total = displayimage($start,$limit); 
	
	
	// Display the items by category //
	else {
		$total = display_by_category($selopt, $start, $limit);
	}

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