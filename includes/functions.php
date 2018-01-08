
<?php 
session_start(); 
$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$dbuser = getenv("databaseuser");
$dbpwd = getenv("databasepassword");
$dbname = getenv("databasename");
// Making database connection //
$connection=mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);
if(!$connection){
	die("connection failed" .mysqli_error());
}


// confirm query
function confirm($result){
  global $connection;
  if(!$result){
    die(mysqli_error($connection));
  }
}

//clean extra spaces, slashes of form input //
function clean($data) {
  $data= trim($data);
  $data= stripslashes($data);
  $data= htmlspecialchars($data);
  return $data;
}


// To register a new user //
function register() {
	global $connection; 
    global $p1;
    $p1=md5($p1);
    global $username;
    global $firstname;
    global $lastname;
    global $email;
    global $address;
    global $phone;

      $query="SELECT * FROM users_data WHERE username='$username'";
      $re=mysqli_query($connection,$query);
      if(mysqli_num_rows($re) > 0){
        echo"Username already exits";
      }
        else{
             $insert="INSERT INTO users_data (firstname,lastname,username,password,email,phone,address,date) 
          VALUES('$firstname','$lastname','$username','$p1','$email','$phone','$address',NOW())";

      $re=mysqli_query($connection,$insert);
       global $var;
      if (!$re) {
            die(" insertion failed" .mysqli_error($connection));
                 }   
          else{
              header("location:login.php");
              }
        }

      }

// for user login //
function login() {
  	if(!empty($_POST['lusername'])) { 
    $u=$_POST['lusername'] ;
    $p=md5($_POST['lpassword']);
    
    
    global $connection; 

    $query = mysqli_query($connection,"SELECT * FROM users_data where username = '$u' AND password = '$p'  "); 
    
    $row = mysqli_fetch_array($query) ; 

    if((!empty($row['username']) || !empty($row['email'])) AND !empty($row['password'])) { 
      
      if($row['username']=="admin") {
        $_SESSION['username']='admin';
        header ("location:admin/admin.php");
        die();
      }
      else {
        $id=$row['user_id'];
     $_SESSION['username']=$u;
     $_SESSION['userid']=$id;
     header ("location:index.php");
   }
    } 
      else { 
        $lmessage="Incorrect Username and Password";
        return $lmessage;
      } 
    } 

}

//add category
function addcategory($p_category) {
	global $connection;
	$query="SELECT * FROM category WHERE category_name='$p_category'";
    $result=mysqli_query($connection,$query);
	
	if(mysqli_num_rows($result) > 0){
        echo"Category already exits";
    }
    else {  
		$add_category="insert into category (category_name) value('$p_category')";

	$add_result=mysqli_query($connection, $add_category);
	if($add_result){
		echo "<script>alert('Sucessfully added')</script>";
	}
	else {
		die("try again" .mysqli_error($connection));
	}
}
}


//insert items into database
function insert($p_cat,$p_name,$p_img1,$p_price,$p_desc,$p_keywords) {
	global $connection;
	$insert_products=
	"insert into products (category_id , date , product_name , p_img1 , product_price , product_det , product_keyword)
		value ('$p_cat' , NOW() , '$p_name' , '$p_img1' , '$p_price' , '$p_desc' , '$p_keywords')";

	$insert_result=mysqli_query($connection,$insert_products);
	if($insert_result){
		echo "<script>alert('Sucessfully inserted')</script>";
	}
	else {
		die("try again" .mysqli_error($connection));
	}
}

// Displaying category list for inserting items
 function displaycat($selopt) {
    global $connection;
    $query = "SELECT * FROM category";
    $result= mysqli_query($connection,$query);
    $o="";
    if($result){
      while($row=mysqli_fetch_array($result)) {
         $o.="<option value=$row[0]";
         if ($selopt == $row[0]) {
         $o.=" selected='true' ";
        }
         $o.= "> $row[1] </option>";
      }
    }
    else {
      die("error" .mysqli_error($connection));
    }
    echo $o;
  }



 function displayimage($start, $limit) {
    global $connection;
    $query = "SELECT * FROM products ORDER BY product_name LIMIT $start, $limit";
    $result = mysqli_query($connection,$query);

    while($row=mysqli_fetch_array($result)) {
    	$id=$row['product_id'];
    	$name=$row['product_name'];
    	$price=$row['product_price'];
    	$image=$row['p_img1'];
      $description = $row['product_det'];


      // Displaying image, image name and its price //
echo  
	"<div class='col-lg-3 col-sm-6 col-xs-12 text-center'>
		<div class='th thumbnail'>
			
			<a class='pop'><img src='images/$image' class='im thumbnail img-responsive img-rounded' alt='$id'> </a>
        

      <div class='modal fade' id='$id'>
      <div class='modal-dialog'>
        <div class='modal-content'>              
          <div class='modal-body'>
            <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span>
              <span class='sr-only'>Close</span></button>
            </div>
              
              <div class='row'>
                <div class='col-lg-6 col-sm-12'>
                  <img src='' class='imagepreview img-responsive' style='width: 100%;' > </hr>
                  <span class='label label-danger'>   $name     </span>  &nbsp&nbsp|&nbsp 
                  <span class='label label-info'>   Rs. $price  </span> 
                </div>

                  <div class='col-lg-6 col-sm-12'>
                  <pre> $description
                  </pre>
                  </div>
            </div>
          </div>

          <div class='modal-footer'>
        <a href='addtocart.php?id=$id&name=$name' class='btn btn-info addtocartbtn'>
          <span class='glyphicon glyphicon-shopping-cart'></span>
            <strong> Add to Cart</strong> 
        </a> 
      </div>


        </div>
      </div>
      </div>


		    <h4 class='text-center itemsinfo'> 
		    	<strong> 
		    		<span class='label label-danger'>   $name     </span>  &nbsp&nbsp|&nbsp 
		    		<span class='label label-success'>   Rs. $price  </span> 
		    	</strong>
		    </h4>

		    <a href='addtocart.php?id=$id&name=$name' class='btn btn-info addtocartbtn'>
		    	<span class='glyphicon glyphicon-shopping-cart'></span>
		    		<strong> Add to Cart</strong> 
		    </a> 
		
		</div>
	</div>";
    }


      //fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($connection,"select * from products"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);

return $total;
}


// displaying products on the basis of category //
function display_by_category($bycategory, $start, $limit) {
  global $connection;
  $query="SELECT * FROM products WHERE category_id='$bycategory' ORDER BY product_name LIMIT $start, $limit";
  $result=mysqli_query($connection,$query);
  
    while($row=mysqli_fetch_array($result)) {
    	$id=$row['product_id'];
    	$name=$row['product_name'];
    	$price=$row['product_price'];
    	$image=$row['p_img1'];
      $description = $row['product_det'];

           // Displaying image, image name and its price //
echo  
  "<div class='col-lg-3 col-sm-6 col-xs-12 text-center'>
    <div class='th thumbnail'>
      
      <a class='pop'><img src='images/$image' class='im thumbnail img-responsive img-rounded' alt='$id'> </a>
        

      <div class='modal fade' id='$id'>
      <div class='modal-dialog'>
        <div class='modal-content'>              
          <div class='modal-body'>
            <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span>
              <span class='sr-only'>Close</span></button>
            </div>
              
              <div class='row'>
                <div class='col-lg-6 col-sm-12'>
                  <img src='' class='imagepreview img-responsive' style='width: 100%;' > </hr>
                  <span class='label label-danger'>   $name     </span>  &nbsp&nbsp|&nbsp 
                  <span class='label label-info'>   Rs. $price  </span> 
                  </div>

                  <div class='col-lg-6 col-sm-12'>
                  <pre> $description
                  </pre>
                  </div>
            </div>
          

          </div>

          <div class='modal-footer'>
        <a href='addtocart.php?id=$id&name=$name' class='btn btn-info addtocartbtn'>
          <span class='glyphicon glyphicon-shopping-cart'></span>
            <strong> Add to Cart</strong> 
        </a> 
      </div>


        </div>
      </div>
      </div>


        <h4 class='text-center itemsinfo'> 
          <strong> 
            <span class='label label-danger'>   $name     </span>  &nbsp&nbsp|&nbsp 
            <span class='label label-success'>   Rs. $price  </span> 
          </strong>
        </h4>

        <a href='addtocart.php?id=$id&name=$name' class='btn btn-info addtocartbtn'>
          <span class='glyphicon glyphicon-shopping-cart'></span>
            <strong> Add to Cart</strong> 
        </a> 
    
    </div>
  </div>";
    }


          //fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($connection,"select * from products WHERE category_id='$bycategory'"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);

return $total;
}


// Searching product //
function search_product($search_terms, $start, $limit) {
  global $connection;
  $query="SELECT * FROM products WHERE MATCH(product_name, product_det, product_keyword) AGAINST('$search_terms' IN BOOLEAN MODE)";
  $result=mysqli_query($connection,$query);
  
    while($row=mysqli_fetch_array($result)) {
      $id=$row['product_id'];
      $name=$row['product_name'];
      $price=$row['product_price'];
      $image=$row['p_img1'];
      $description = $row['product_det'];

           // Displaying image, image name and its price //
echo  
  "<div class='col-lg-3 col-sm-6 col-xs-12 text-center'>
    <div class='th thumbnail'>
      
      <a class='pop'><img src='images/$image' class='im thumbnail img-responsive img-rounded' alt='$id'> </a>
        

      <div class='modal fade' id='$id'>
      <div class='modal-dialog'>
        <div class='modal-content'>              
          <div class='modal-body'>
            <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span>
              <span class='sr-only'>Close</span></button>
            </div>
              
              <div class='row'>
                <div class='col-lg-6 col-sm-12'>
                  <img src='' class='imagepreview img-responsive' style='width: 100%;' > </hr>
                  <span class='label label-danger'>   $name     </span>  &nbsp&nbsp|&nbsp 
                  <span class='label label-info'>   Rs. $price  </span> 
                  </div>

                  <div class='col-lg-6 col-sm-12'>
                  <pre> $description
                  </pre>
                  </div>
            </div>
          

          </div>

          <div class='modal-footer'>
        <a href='addtocart.php?id=$id&name=$name' class='btn btn-info addtocartbtn'>
          <span class='glyphicon glyphicon-shopping-cart'></span>
            <strong> Add to Cart</strong> 
        </a> 
      </div>

      
        </div>
      </div>
      </div>


        <h4 class='text-center itemsinfo'> 
          <strong> 
            <span class='label label-danger'>   $name     </span>  &nbsp&nbsp|&nbsp 
            <span class='label label-success'>   Rs. $price  </span> 
          </strong>
        </h4>

        <a href='addtocart.php?id=$id&name=$name' class='btn btn-info addtocartbtn'>
          <span class='glyphicon glyphicon-shopping-cart'></span>
            <strong> Add to Cart</strong> 
        </a> 
    
    </div>
  </div>";
    }


          //fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($connection,"SELECT * FROM products WHERE MATCH(product_name, product_det, product_keyword) AGAINST('$search_terms' IN BOOLEAN MODE)"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);

return $total;
}


// Get item by id
function get_item_by_id($id) {
  global $connection;
  $query = "SELECT * FROM products where product_id='$id'";
  $result = mysqli_query($connection,$query);
  if($result){
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  return $row;
  }
  else die("error" . mysqli_error($connection));
}

// Get user by id
function get_user_by_id($id) {
  global $connection;
  $query = "SELECT * FROM users_data where user_id='$id'";
  $result = mysqli_query($connection,$query);
  if($result){
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  return $row;
  }
  else die("error" . mysqli_error($connection));
}


function all_items($start,$limit) {
	global $connection;
	$query="SELECT * FROM products ORDER BY product_name LIMIT $start, $limit";
	$result = mysqli_query($connection,$query);

	while($row=mysqli_fetch_array($result)) {
    	$id=$row['product_id'];
    	$name=$row['product_name'];
    	$price=$row['product_price'];
    	$date=$row['date'];
    	$image=$row['p_img1'];
    	$desc=$row['product_det'];

    echo "
    	<tr> 
			<td>
				<img class='img-responsive img-rounded img-thumbnail imgsmall' src='../images/$image'>
			</td>
			<td> $name </td>
			<td> Rs. $price </td>
			<td> $date </td>
			<td> $desc </td>
			<td> <a href='deleteitem.php?id=$id' class='btn btn-danger'>Delete </a> </td>
			
		</tr>
		";
	}

	//fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($connection,"select * from products"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);

return $total;

}




function all_registered_users($start,$limit) {
  global $connection;
  $query="SELECT * FROM users_data ORDER BY user_id LIMIT $start, $limit";
  $result = mysqli_query($connection,$query);

  while($row=mysqli_fetch_array($result)) {
      $id=$row['user_id'];
      $username=$row['username'];
      $email=$row['email'];
      $date=$row['date'];
      $address=$row['Address'];
      $phone=$row['phone'];

    echo "
      <tr> 
      <td> $username </td>
      <td> $date </td>
      <td> $address </td>
      <td> $phone </td>
      <td> $email </td>
      <td> <a href='deleteuser.php?userid=$id' class='btn btn-danger'>Delete </a> </td>
    </tr>
    ";
  }

  //fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($connection,"select * from users_data"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);

return $total;

}


function checkout(){
  global $connection;
  $userid=$_SESSION['userid'];
  $query="INSERT INTO orders (user_id, date) VALUES('$userid', NOW())";
  $result_orders=mysqli_query($connection,$query);
  confirm($result_orders);


  $queryo="select order_id from orders where user_id='$userid'";
  $orders=mysqli_query($connection,$queryo);
  confirm($orders);

  while($ordersrow=mysqli_fetch_array($orders)){
    $o_id=$ordersrow['order_id'];
  


  foreach ($_SESSION['citems'] as $val) {
    $id=$val['itemid'];
    $quantity=$val['quantity'];
    $row = get_item_by_id($id);

    $pid=$row['product_id'];
    $name=$row['product_name'];
    $price=$row['product_price'];

    $query="INSERT INTO orders_item (order_id, product_id, quantity, price) 
    VALUES('$o_id','$pid','$quantity', '$price')";
    $result_orders_items=mysqli_query($connection,$query);   
    confirm($result_orders_items);
  }
}
  unset($_SESSION['citems']);
}



function view_processing() {
  $subtotal=0;
   global $connection;
  $userid=$_SESSION['userid'];
  $queryo="select * from orders where user_id='$userid' ORDER BY date DESC LIMIT 1";
  
  $result = mysqli_query($connection,$queryo);

  while($row=mysqli_fetch_array($result)) {
      $oid=$row['order_id'];
      $uid=$row['user_id'];
      $date=$row['date'];
      $users=get_user_by_id($uid);
      $user_name=$users['username'];
      $address=$users['Address'];
      $phone=$users['phone'];

      echo " 
        <div class='table-responsive'>
          <table class='table table-condensed userordert'>
            <tr>
            <th> Order_id: $oid <th>
            <th> Username: $user_name </th>
            <th> Address: $address </th>
            <th> Phone: $phone </th>
            <th> Order_Date: $date </th>     
            
            </tr>
          </table>
        </div>
      ";

      $q="SELECT * FROM orders_item WHERE order_id='$oid'";
      $r=mysqli_query($connection,$q);
      
      echo "
      <div class='tablediv table-responsive'>
      <table class='table table-condensed orders'>
      <tr>
        <th> Item Name </th>
        <th> Quantity </th>
        <th> Price </th>
        <th> Total </th>
      </tr>";

      while($ro=mysqli_fetch_array($r)){
        $p_id=$ro['product_id'];
        $q=$ro['quantity'];
        $price=$ro['price'];

        $answer=get_item_by_id($p_id);
        $name=$answer['product_name'];
        $total=$q*$price;
        $subtotal=$total+$subtotal;

    echo " 
        <tr> 
        <td> $name </td>
        <td> $q </td>
        <td> $price </td>
        <td> $total </td>
      </tr>
    ";
      }
      echo "<tr><td colspan='4'> Total: $subtotal </td></tr></table></div><hr>";
  }


}


//all users orders
function all_orders($start,$limit) {
  global $connection;
  $query="SELECT * FROM orders ORDER BY date LIMIT $start, $limit";
  $result = mysqli_query($connection,$query);

  while($row=mysqli_fetch_array($result)) {
      $oid=$row['order_id'];
      $uid=$row['user_id'];
      $date=$row['date'];
      $users=get_user_by_id($uid);
      $user_name=$users['username'];
      $address=$users['Address'];
      $phone=$users['phone'];

      echo " 
      <button class='btn-block' data-toggle='collapse' data-target='#$oid'>
        <div class='table-responsive'>
          <table class='table table-condensed userordert'>
            <tr>
            <th> Order_id: $oid <th>
            <th> Username: $user_name </th>
            <th> Address: $address </th>
            <th> Phone: $phone </th>
            <th> Order_Date: $date </th>     
            
            </tr>
          </table>
        </div>
      </button>";

      $q="SELECT * FROM orders_item WHERE order_id='$oid'";
      $r=mysqli_query($connection,$q);
      
      echo "
      <div class='collapse' id='$oid'>
      <div class='tablediv table-responsive'>
      <table class='table table-condensed orders'>
      <tr>
        <th> Item id </th>
        <th> Item Name </th>
        <th> Quantity </th>
        <th> Price </th>
        <th> Total </th>
      </tr>";

      while($ro=mysqli_fetch_array($r)){
        $p_id=$ro['product_id'];
        $q=$ro['quantity'];
        $price=$ro['price'];

        $answer=get_item_by_id($p_id);
        $name=$answer['product_name'];
        $total=$q*$price;

    echo " 
        <tr> 
        <td> $p_id </td>
        <td> $name </td>
        <td> $q </td>
        <td> $price </td>
        <td> $total </td>
      </tr>
    ";
      }
      echo "</table></div></div><hr>";
  }

  //fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($connection,"select * from orders"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);

return $total;
}

?>
