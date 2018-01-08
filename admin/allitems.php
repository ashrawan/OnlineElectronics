

<?php include("header.php"); ?>


<div class='tablediv table-responsive'>
	<table class='table table-condensed tableviewcart'>
		<tr>
			<th> Item Image </th> 
			<th> Item Name </th> 
			<th> Item Price </th> 
			<th> Date </th>   
			<th> Description </th> 
			<th colspan="2"> Options </th>
		</tr>

<?php

$start=0;
$limit=8;
 
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $start=($id-1)*$limit;
}
else{
    $id=1;
}

$total=all_items($start,$limit);
?>

</table>
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


<?php include("footer.php"); ?>
