


<?php include("header.php"); ?>


<?php
$errors=array();   // array ko keep track of error
if(isset($_POST['insert'])) {
	$p_name=clean($_POST['p_name']);
	$p_cat=($_POST['selectedvalue']);
	$p_price=clean($_POST['p_price']);
	$p_desc=clean($_POST['p_desc']);
	$status='on';
	$p_keywords=clean($_POST['p_keywords']);


// Checking for image errors 
	if(!empty($_FILES["p_img1"]["name"])) { 
		// if(getimagesize($_FILES['p_img1']['tmp_name']) == FALSE) {
	 //    	$errors['file']="please select a valid image";
	 //    }
	  
			$p_img1=$_FILES['p_img1']['name'];     //image
			$temp1=$_FILES['p_img1']['tmp_name'];  // tmp image name
		
	}
	
	else {
	    $errors['file']="Image required";
	}


// checking for all form field errors
	if(empty($p_name)){
      $errors['item_name']="Item Name Required";
    }

	if(empty($p_cat)){
      $errors['item_cat']="Item Category must be Selected";
    }
    
    if(empty($p_price)){
      $errors['item_price']="Item price must be set";
    }

    if(!is_numeric($p_price)){
      $errors['item_price']="Item Price required, should be Number";
    }

    if(count($errors)==0){

	// uploading images to folders
	move_uploaded_file($temp1, "../images/$p_img1");
	
	// calling function to insert item
	insert($p_cat,$p_name,$p_img1,$p_price,$p_desc,$p_keywords);
		}
}
?>

<!-- page insertitem.php   Add New item into database Box  -->
<div class="col-lg-6 col-lg-offset-1 insertbox">
<form method="post" enctype="multipart/form-data">

<table>
	<tr>
		<td>Product Name: </td>
		<td><input type="text" class="form-control" name="p_name" 
		value=" <?php if(isset($p_name)) echo $p_name; ?>" >
			<span class="red"><?php if(isset($errors['item_name'])) echo $errors['item_name']; ?></span>
		</td>

	</tr>

	<tr>
		<td>Product Category: </td>
		<td>
		<select class="form-control" name="selectedvalue"> 
			<option></option>
				<?php 
					$selopt="";
					if(isset($_POST['selectedvalue'])) $selopt = $_POST['selectedvalue'];
					displaycat($selopt); 
				?> 
		</select>
			<span class="red"><?php if(isset($errors['item_cat'])) echo $errors['item_cat']; ?></span>
		</td>
	</tr>

	<tr>
		<td>Product price: </td>
		<td><input type="number" class="form-control" name="p_price">
			<span class="red"><?php if(isset($errors['item_price'])) echo $errors['item_price']; ?></span>
		</td>
	</tr>

	<tr>
		<td>Product Image: </td>
		<td><input type="file" class="form-control" name="p_img1">
			<span class="red"><?php if(isset($errors['file'])) echo $errors['file']; ?> </span>
		</td>
	</tr>
	
	<tr>
		<td>Product desc: </td>
		<td><pre><textarea rows="4" cols="50" name="p_desc">
		<?php if(isset($p_desc)) echo $p_desc; ?></textarea></pre>
		</td>
	</tr>

	<tr>
		<td>Product keywords: </td>
		<td><input type="text" class="form-control" name="p_keywords"
		value=" <?php if(isset($p_keywords)) echo $p_keywords; ?>" >
		</td>
	</tr>

	<tr>
		<td colspan=2><input type="submit" class="btn btn-info btn-lg btn-block" name="insert" value="Insert Product"></td>
	</tr>

</table>
</form>
</div>



<?php   //For adding new category

if(isset($_POST['addcat'])){
	$err=array();
	$category_name=clean($_POST['p_category']);

	if(empty($category_name)){
		$err['cat']="Category name is empty";
	}
	else {
		addcategory($category_name);
	}
}

?>
<!-- page insertitem.php   Add Category Box  -->
<div class="col-lg-3 col-lg-offset-1 insertbox">
<form method="post" enctype="multipart/form-data">

<table>
	<tr>
		<td>New Category</td>
		<td><input type="text" class="form-control" name="p_category" 
		value=" <?php if(isset($p_category)) echo $p_category; ?>" >
			<span class="red"><?php if(isset($err['cat'])) echo $err['cat']; ?></span>
		</td>
	</tr>

	<tr>
		<td colspan="3"><input type="submit" class="btn btn-info btn-block" name="addcat" value="Add"></td>
	</tr>

</table>
</form>
</div>


 <?php include("footer.php"); ?>
