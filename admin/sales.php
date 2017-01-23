<?php
require "includes/connect.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {
if($_SESSION["role"] == 1) {
$uid = $_SESSION["uid"];
$role = $_SESSION["role"];
include "static/head.php";
include "static/sidebar.php";
include "static/header.php";
?>
	<div class="right_col" role="main">
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
    <div class="x_title">
    <h2>Pending Orders </h2>                    
    <div class="clearfix"></div>
    </div>
    <div class="x_content">
			<?php						
			$sql = "SELECT * FROM `bill` WHERE `orderstatus`='2' ";
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
    <table class="table">
    <thead>
    <tr>
    <th>ORDER ID</th>
    <th>NAME</th>
	<th>Address</th>
	<th>Amount</th>
	<th>Date&Time</th>
	<th>STATUS</th>
	<th>Action</th>
    </tr>
    </thead>
    <tbody>
			<?php			   
			while($row = $result->fetch_assoc())
			{
			$billid =  $row["billid"];
			$invoiceno =  $row["invoiceno"];
			$amount =  $row["amount"];
			$billname =  $row["billname"];
			$address1 =  $row["address1"];
			$address2 =  $row["address2"];
			$district = $row["district"];
			$state = $row["state"];
			$country = $row["country"];
			$postalcode = $row["postalcode"];
			$billtime = $row["billtime"];
			$status =  $row["status"];					   
			?>		
    <tr>
    <td><?php echo $invoiceno; ?></td>
	<td><?php echo $billname; ?></td>
	<td><?php echo $address1."," .$address2. "<br>" .$district. "," .$state. "<br>" .$country. "<br>" .$postalcode; ?></td>
	<td><?php echo $amount; ?></td>
	<td><?php echo $billtime; ?></td>
	<td><?php if($status==4){echo "Completed";} ?></td>
	<td><a href="vieworder.php?billid=<?php echo $billid;	?>" class="btn btn-success">View</a></td>
	
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
<?php
include "static/footer.php";
} else{
header('Location: ./index.php');
}
} else {
header('Location: login.php');
}
?>