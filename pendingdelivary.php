<?php
require "admin/includes/connect.php";
require('header.php');
if(isset($_SESSION['uid']) || isset($_SESSION['did']) ){
	$uid  = $_SESSION['uid'];
	$did  = $_SESSION['did'];
	require('topmenu.php');
	
?>
<body>
    <div class="container-fluid paddingopx">
	<section id="cart_items ">
	<div class="jumbotron">
	<div class="container ">
	<div class="row ">
	<div class="col-md-12">
	<p><span style="font-size:34px;padding-bottom:90px;font-family: OpenSans-light">Pending Orders</span>
	<span style="float: right;"><a href="myaccount.php" class="btn btn-success"> BACK</a></span></p>
	<div  class="table-responsive cart_info">
	<?php	
	 $sql = "SELECT * FROM `bill` WHERE `userid`='".$uid."' AND `status` ='1'";
	$result = $con->query($sql);
	if ($result->num_rows == 0) 
	{
	?>
	<div class="alert alert-infos">
	No Order Found
	</div>
	<?php
	}
	else
	{	
	?>
	<table style="background-color:white;"class="table table-bordered">
	<thead>
	<tr class="cart_menu">
	<td class="price"style="text-align:center;">ORDER ID</td>
	<td class="description"style="text-align:center;">DATE</td>
	<td class="quantity"style="text-align:center;">AMOUNT</td>
	<td class="quantity"style="text-align:center;">STATUS</td>							
	</tr>					
	</thead>
	<tbody>
	<?php
	while($row = $result->fetch_assoc())
	{
	$invoiceno =  $row["invoiceno"];
	$billtime =  $row["billtime"];
    $amount =  $row["amount"];
	$status =  $row["status"];
				   
	?>
	<tr>			
	<td class="cart_description">
	<h4><span style="color:#cccccc;"><center><?php echo $invoiceno; ?><center></span></h4>
	</td>
	<td class="cart_description">
	<h4><span style="color:#cccccc;"><center><?php echo $billtime; ?></center></span></h4>
	</td>
	<td class="cart_description">
	<h4><span style="color:#cccccc;"><center><?php echo $amount; ?></center></span></h4>
	</td>				
				
	<td class="cart_price"style="text-align:center;">
	<p><?php if($status==1){
		echo "PENDING";
	}else{
		echo "DELIVERED";
	}?></p>	
	</td>
	
					
	</tr>			
	<?php
		}
		}	
	?>
	</tbody>			
	</table>	
	</div>
	</div>
	</div>
	</div>
	</div>
	</section>		
	<?php
	require('footer.php');
	?>
	</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
<?php
}
?><?php
require "admin/includes/connect.php";
require('header.php');
if(isset($_SESSION['uid']) || isset($_SESSION['did']) ){
	$uid  = $_SESSION['uid'];
	$did  = $_SESSION['did'];
	require('topmenu.php');
?>
<body>
    <div class="container-fluid paddingopx">
	<section id="cart_items ">
	<div class="jumbotron">
	<div class="container ">
	<div class="row ">
	<div class="col-md-12">
	<p><span style="font-size:34px;padding-bottom:90px;font-family: OpenSans-light">Pending Order</span>
	<span style="float:right"><a href="myaccount.php" class="btn btn-success">BACK</a></span>
	<p style="font-size:20px;padding-bottom:40px;color:#666666;">	</p></p>
	<div  class="table-responsive cart_info">
	<?php						
	$sql = "SELECT * FROM `order_history` WHERE `uid`='".$uid."' ";
	$result = $con->query($sql);
	if ($result->num_rows == 0)
	{
	?>
	<div class="alert alert-info">
	No Order Found
	</div>
	<?php
	}
	else
	{
	?>
	<table style="background-color:white;"class="table table-bordered">
	<thead>
	<tr class="cart_menu">
	<td class="price"style="text-align:center;">ORDER ID</td>
	<td class="price"style="text-align:center;">USERNAME</td>
	<td class="description"style="text-align:center;">DATE</td>
	<td class="quantity"style="text-align:center;">PRODUCT</td>
	<td class="quantity"style="text-align:center;">QUANTITY</td>
	<td class="quantity"style="text-align:center;">TOTAL</td>
	<td class="quantity"style="text-align:center;">STATUS</td>
	</tr>
	</thead>
	<tbody>
	<?php			   
	while($row = $result->fetch_assoc())
		{
    $pname =  $row["pname"];
    $brand =  $row["brand"];
    $pcode =  $row["pcode"];
    $price =  $row["price"];
    $total =  $row["total"];
    $qty = $row["qty"];
    $orderid = $row["orderid"];
    $order_date =  $row["order_date"];
    $status =  $row["status"];
    $username = $row["username"];					   
	?>		
	<tr>				
	<td class="cart_description">
	<h4><span style="color:#cccccc;"><?php echo $orderid; ?></span></h4>
	</td>
	<td class="cart_description">
	<h4><span style="color:#cccccc;"><?php echo $username; ?></span></h4>
	</td>
	<td class="cart_description">
	<h4><span style="color:#cccccc;"><?php echo $order_date; ?></span></h4>
	</td>								
	<td class="cart_quantity">
	<h4><a style="text-decoration: none;color:#000000;" href=""><span style="color:#cccccc;"> PRODUCT NAME :</span><?php echo $pname;?>   </a> <span style="color:#cccccc;">(<?php echo $pcode;?>)</span></h4>
	<p style="text-decoration: none;color:#000000;"><span style="color:#cccccc;"> BRAND :</span> <?php echo $brand;?></p>						
	</td>					
	<td class="cart_price"style="text-align:center;">
	<p><?php echo $qty;?></p>
	</td>
	<td class="cart_price"style="text-align:center;">
	<p><img src="img/ic_rs_gray_16_px.png"><?php echo $total;?></p>
	</td>
	<td class="cart_total">
	<p class="cart_total_price"style="text-align:center;"><?php if($status==1){echo "Completed";}else{echo "pending";}?></p>
	</td>			
	</tr>	
	<?php
		}
		}
	?>									
	</tbody>		
	</table>
	</div>			
	</div>
	</div>
	</div>
	</div>
	</section>	
	<?php
	require('footer.php');
	?>
</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
<?php
}
?>