<?php
require "admin/includes/connect.php";
require('header.php');
//$_SESSION['uid'] ='admin001';
if(isset($_SESSION['uid']) )
{
	 $uid  = $_SESSION['uid'];
	 $role  = $_SESSION['role'];
require('topmenu.php');
?>
<body>
    <div class="container-fluid paddingopx">
	
	<div class="jumbotron">						
	<h2 style="padding-left:75px;font-size:30px;"><b>My account</b></h2>
	<div class="row">
	<div class="col-md-12">
	<style>
	table {
	border-collapse: collapse;
	width: 1000px;
	}
	th, td {
	text-align: left;
	padding: 19px;
	}

	tr:nth-child(even){background-color: white}
	th {
		background-color: gray;
		color: white;
		width: 100%;
		}
	tr
		{
		background-color: #f2f2f2;
		}				
	</style>
	</head>
	<body>
	<?php
		if($_SESSION['role'] == 2){
		$uid =  $_SESSION["uid"];
	?>
		<CENTER><table></CENTER>
		<tr>
		<th><h3>1.ORDERS-see & modify recent orders</h3></th>
		</tr>
		<tr>
		<td> 
		<div class="container">
		<div class="row">
		<div class="col-md-12">
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/> </a><a href="orderhistory.php" style=" color:#3aaaa3;"><b>Order history</a>
		</div>
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/> </a><a href="pendingorder.php" style=" color:#3aaaa3;"><b>Pending order</a>
		</div>
		</div>		
		</div>
		</td>
		</tr>
		<!--<tr>
		<th><h3>2.PAYMENT - Credit & Debit card</h3></th>
		</tr>
		<tr>
		<td> 
		<div class="container">
		<div class="row">
		<div class="col-md-12">					
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/> </a><a href="paymenthistory.php" style=" color:#3aaaa3;"><b> Payment History</a>
		</div>
		</div>		
		</div>
		</td>
		</tr>-->
		<tr>
		<th><h3>2.SECURITY SETTINGS</h3></th>
		</tr>
		<tr>
		<td>
		<div class="container">
		<div class="row">
		<div class="col-md-12">
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/></a> <a href="update_password.php" style=" color:#3aaaa3;"><b>Password settings</a>
		</div>
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/> </a><a href="edit_user_profile.php" style=" color:#3aaaa3;"><b> Profile settings</a>
		</div>
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/></a> <a href="edit_user_pic.php" style=" color:#3aaaa3;"><b>Profile Picture</a>
		</div>					
		</div>		
		</div>
		<tr>
		<th><h3>3.PERSONALISATION-participation & public content </h3></th>
		</tr>			
		<?php	
		$sql = "SELECT * FROM `users`";
		$result = $con->query($sql);
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
			$uid =  $row["uid"];
			}
		}
		?>
		<td>				
		<div class="container">
		<div class="row">
		<div class="col-md-12">	
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/></a> <a href="view_user_profile.php" style=" color:#3aaaa3;"><b>Your profile</a>
		</div>
		</div>
		</div>		
		</div>
		</td>								
		</table>		
		<?php					
			}
			elseif($_SESSION['role'] == 3){
			$did =  $_SESSION["did"];
			?>
			<CENTER><table></CENTER>
		<tr>
		<th><h3>1.ORDERS-see & modify recent orders</h3></th>
		</tr>
		<tr>
		<td> 
		<div class="container">
		<div class="row">
		<div class="col-md-12">
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/> </a><a href="orderhistory.php" style=" color:#3aaaa3;"><b>Order history</a>
		</div>
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/> </a><a href="pendingorder.php" style=" color:#3aaaa3;"><b>Pending order</a>
		</div>
		</div>		
		</div>
		</td>
		</tr>
		<tr>
		<th><h3>2.DELIVARY & PAYMENT</h3></th>
		</tr>
		<tr>
		<td> 
		<div class="container">
		<div class="row">
		<div class="col-md-12">	
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/> </a><a href="delivaryupdate.php" style=" color:#3aaaa3;"><b> Delivary Update</a>
		</div>
<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/> </a><a href="pendindelivary.php" style=" color:#3aaaa3;"><b> Pending Delivary</a>
		</div>		
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/> </a><a href="paymenthistory.php" style=" color:#3aaaa3;"><b> Payment History</a>
		</div>
			<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/> </a><a href="wallet.php" style=" color:#3aaaa3;"><b>Payment Request</a>
		</div>
		</div>		
		</div>
		</td>
		</tr>
		<tr>
		<th><h3>3.SECURITY SETTINGS</h3></th>
		</tr>
		<tr>
		<td>
		<div class="container">
		<div class="row">
		<div class="col-md-12">
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/></a> <a href="update_password.php" style=" color:#3aaaa3;"><b>Password Settings</a>
		</div>
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/> </a><a href="edit_user_profile.php" style=" color:#3aaaa3;"><b> Profile settings</a>
		</div>
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/></a> <a href="edit_user_pic.php" style=" color:#3aaaa3;"><b>Profile Picture</a>
		</div>					
		</div>		
		</div>
		<tr>
		<th><h3>4.PERSONALISATION-participation & public content </h3></th>
		</tr>			
		<?php	
		$sql = "SELECT * FROM `distributer`";
		$result = $con->query($sql);
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
			$did =  $row["did"];
			}
		}
		?>
		<td>				
		<div class="container">
		<div class="row">
		<div class="col-md-12">	
		<div class="col-md-3">
		<a href="#" ><img src="img/ic_down_arrow_green2.png"/></a> <a href="view_user_profile.php" style=" color:#3aaaa3;"><b>Your profile</a>
		</div>
		</div>
		</div>		
		</div>
		</td>	
			
		</table>
		<?php
		}								
		?>
		</div>
		</div>
		</div>	
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