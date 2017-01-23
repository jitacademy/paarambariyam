<?php
include('admin/includes/connect.php');
if(isset($_SESSION['uid']) || isset($_SESSION['did']) ){
	$uid  = $_SESSION['uid'];
if($_POST['reqamount']){
	$amount =  $_POST['amount'];
	$reqamount = $_POST['reqamount'];
	$finamount = $amount - $reqamount;
	if($finamount>=0){
	$qry="INSERT INTO `requestpayment`(`rid`, `uid`, `amount`, `status`) VALUES ('','$uid',
'$reqamount','1')";
$result1 = $con->query($qry);
if($result1){
		$qry1="UPDATE `wallet` SET `amount`='$finamount' WHERE `uid`='$uid'";
$result2 = $con->query($qry1);
	
}
	}else{
		$error = "Please request below your wallet amount";
	}
	
}

require('header.php');
?>
<body>
    <div class="container-fluid paddingopx">
	<?php 
	require('topmenu.php');
	?>
	<section id="cart_items ">
	<div class="jumbotron">
	<div class="container ">
	<div class="row ">
	<div class="col-md-12">
	<p><span style="font-size:34px;padding-bottom:90px;font-family: OpenSans-light">MY WALLET</span>
	<p style="font-size:20px;padding-bottom:40px;color:#666666;"><?php echo $error; ?></p>
	<div  class="table-responsive cart_info">
	<table style="background-color:white;"class="table table-bordered">
	<thead>
	<tr class="cart_menu">

	<th class="price"style="text-align:center;">DATE</th>
	<th class="quantity"style="text-align:center;">WALLET AMOUNT</th>
	<th class="quantity"style="text-align:center;">REQUEST AMOUNT</th>	
	<th class="quantity"style="text-align:center;">REQUEST</th>		
	</tr>					
	</thead>
	<tbody>
	<?php	
		$sql = "SELECT * FROM `wallet` WHERE `uid` ='".$_SESSION["uid"]."'";
		$result = $con->query($sql);
		if ($result->num_rows > 0) {				   
		while($row = $result->fetch_assoc())
			{									  
		   $did =  $row["uid"];
		   $price =  $row["amount"];
		   $status =  $row["status"];

if($status=='1'){
	?>					
	<tr>							
	<td class="cart_description">
	<center>
	<h4><span style="color:#cccccc;"><?php echo date("d/m/Y"); ?></span></h4>
	</center>
	</td>
	<td class="cart_description">
	<center>
	<h4><span style="color:#cccccc;"><?php echo $price; ?></span></h4>
	</center>
	</td>
	
	<form id="demo-form2"  action="wallet.php" enctype="multipart/form-data" method="POST">
	<td class="cart_description">
	
	<div class="form-group">
	<input type="text" class="form-control inputreg" placeholder="Request Amount" name="reqamount" id="refamount" />
	<input type="hidden"  name="amount" value="<?php echo $price; ?>" id="amount" />
	</div>
	</td>
	<td class="cart_total">
	<input type="submit" class="btn regbtn" value="REQUEST" name="submit"/>
		
	</td>
</form>	
	</tr>
	<?php
}
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