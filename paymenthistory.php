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
	<p><span style="font-size:34px;padding-bottom:90px;font-family: OpenSans-light">Payment History</span>
	<p style="font-size:20px;padding-bottom:40px;color:#666666;">	
	</p>	
	<div  class="table-responsive cart_info">
	<table style="background-color:white;"class="table table-bordered">
	<thead>
	<tr class="cart_menu">							
	<td class="description"style="text-align:center;">DATE</td>
	<td class="price"style="text-align:center;">TRANSACTION ID</td>
	<td class="quantity"style="text-align:center;">PAYMENT MODE</td>
	<td class="quantity"style="text-align:center;">AMOUNT</td>
	<td class="quantity"style="text-align:center;">STATUS</td>
	</tr>						
	</thead>
	<tbody>
	<?php	
	$sql = "SELECT `transid`, `paymentmode`, `amount`, `paymenttime`, `uid`, `status` FROM `transaction` WHERE `uid`='".$uid."'";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {					   
	while($row = $result->fetch_assoc())
		{
   $tid =  $row["transid"];
   $date =  $row["paymenttime"];
   $mode =  $row["paymentmode"];
   $price = $row["amount"];
   $status =  $row["status"];						   
	?>	
	<tr>
	<td class="cart_description">
	<h4><center><span style="color:#cccccc;"><?php echo $date; ?></span></center></h4>
	</td>
	<td class="cart_total">
	<center><p class="cart_total_price"style="text-align:center;"><?php echo $tid;?></p></center>
	</td>
	<td class="cart_quantity">
	<center><p style="text-decoration: none;color:#000000;"><span style="color:#cccccc;"> <?php echo $mode;?></p></center>				
	</td>					
	<td class="cart_price"style="text-align:center;">
	<center><p><img src="img/ic_rs_gray_16_px.png"><?php echo $price;?></p></center>
	</td>
	<td class="cart_total">
	<center><p class="cart_total_price"style="text-align:center;"><?php if($status==1){echo "Completed";}else{echo "pending";}?></p></center>
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