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
	<p><span style="font-size:34px;padding-bottom:90px;font-family: OpenSans-light">Order History</span>
	<span style="float: right;"><a href="myaccount.php" class="btn btn-success"> BACK</a></span></p>
	<div  class="table-responsive cart_info">
	<?php	
	 $sql = "SELECT * FROM `bill` WHERE `userid`	='".$uid."'";
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
?>