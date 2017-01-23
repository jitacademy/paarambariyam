<?php
require "admin/includes/connect.php";
require('header.php');
if(isset($_SESSION['uid']) || isset($_SESSION['did']) ){
	$uid  = $_SESSION['uid'];
	$did  = $_SESSION['did'];
	require('topmenu.php');
	$query= "SELECT `referalpercent`,`distributionpercent` FROM `sitesettings`";
	$result1 = $con->query($query);
								if ($result1->num_rows > 0) 
								{
								while($row1 = $result1->fetch_assoc()) 
									{
								$referalpercent =  $row1["referalpercent"];
								$distributionpercent =  $row1["distributionpercent"];
									}
								}
	
	
if($_POST['accept']){
	 $uid  = $_SESSION['uid'];
	$invoiceno  = $_POST['invoiceno'];
	$val = $_POST['amount']*$distributionpercent/100;
		$sql = "SELECT `amount` FROM `wallet` WHERE `uid`='$uid'";
								$result = $con->query($sql);
								if ($result->num_rows > 0) 
								{
								while($row = $result->fetch_assoc()) 
									{
								$amount =  $row["amount"];
								$ramount = $val + $amount;
								
								$qry = "UPDATE `wallet` SET `amount`='$ramount' WHERE `uid`='$uid'";
								$result2 = mysqli_query($con, $qry);
								if($result2){
									$qry2 ="UPDATE `bill` SET `status`='2' WHERE `invoiceno`='$invoiceno'";
									$result3 = mysqli_query($con, $qry2);
								}
									}
								}else{
									$qry = "INSERT INTO `wallet`(`wallet_id`, `uid`, `amount`, `status`) VALUES ('','$uid','$val','1')";
								$result2 = mysqli_query($con, $qry);
									if($result2){
									$qry2 ="UPDATE `bill` SET `status`='2' WHERE `invoiceno`='$invoiceno'";
									$result3 = mysqli_query($con, $qry2);
								}
								}
								
}elseif($_POST['reject'])
{
	 $uid  = $_SESSION['uid'];
	$invoiceno  = $_POST['invoiceno'];
	$val =  $_POST['amount']*$referalpercent/100;
				$sql = "SELECT `amount` FROM `wallet` WHERE `uid`='$uid'";
								$result = $con->query($sql);
								if ($result->num_rows > 0) 
								{
								while($row = $result->fetch_assoc()) 
									{
								$amount =  $row["amount"];
								$ramount = $val + $amount;
								
								$qry = "UPDATE `wallet` SET `amount`='$ramount' WHERE `uid`='$uid'";
								$result2 = mysqli_query($con, $qry);
								if($result2){
									$qry2 ="UPDATE `bill` SET `status`='3' WHERE `invoiceno`='$invoiceno'";
									$result3 = mysqli_query($con, $qry2);
								}
									}
								}else{
									$qry = "INSERT INTO `wallet`(`wallet_id`, `uid`, `amount`, `status`) VALUES ('','$uid','$val','1')";
								$result2 = mysqli_query($con, $qry);
									if($result2){
									$qry2 ="UPDATE `bill` SET `status`='3' WHERE `invoiceno`='$invoiceno'";
									$result3 = mysqli_query($con, $qry2);
								}
								}
}
	
?>
<body>
    <div class="container-fluid paddingopx">
	<section id="cart_items ">
	<div class="jumbotron">
	<div class="container ">
	<div class="row ">
	<div class="col-md-12">
	<p><span style="font-size:34px;padding-bottom:90px;font-family: OpenSans-light">Delivary Update</span>
	<span style="float: right;"><a href="myaccount.php" class="btn btn-success"> BACK</a></span></p>
	<div  class="table-responsive cart_info">
	<?php	
	 $sql = "SELECT * FROM `bill` WHERE `refid`='".$uid."' AND `status` ='1'";
	$result = $con->query($sql);
	if ($result->num_rows == 0) 
	{
	?>
	<div class="alert alert-infos">
	No Delivary Found
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
	<td class="quantity"style="text-align:center;">ADDRESS</td>
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
	$address1 = $row["address1"];
	$address2 = $row["address2"];
	$district = $row["district"];
	$state = $row["state"];
	$country = $row["country"];
	$postalcode = $row["postalcode"];
	
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
	<td class="cart_description">
	<h4><span style="color:#cccccc;"><center><?php echo $address1; ?>, <?php echo $address2; ?>
	</br><?php echo $district; ?>, <?php echo $state; ?>
	</br><?php echo $country; ?>, <?php echo $postalcode; ?>
	</center></span></h4>
	</td>			
	<td class="cart_price"style="text-align:center;">
	<form method="post" action="delivaryupdate.php">
	<input type="hidden" name="invoiceno" value="<?php echo $invoiceno; ?>">
	<input type="hidden" name="amount" value="<?php echo $amount; ?>">
 	<input type="submit" class="btn btn-success" value="ACCEPT" name="accept">
	<input type="submit" class="btn btn-warning" value="REJECT" name="reject">
	
	
	</form>
	
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