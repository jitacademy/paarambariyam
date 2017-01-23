<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {



 if($_SESSION["role"] == 1) {

$uid = $_SESSION["uid"];
$role = $_SESSION["role"];

include "static/head.php";
include "static/sidebar.php";
include "static/header.php";
if(isset($_GET["billid"])&&isset($_GET["invoiceno"])){
	
	$invoiceno = $_GET["invoiceno"];
	$qry2 ="UPDATE `bill` SET `status`='3' WHERE `invoiceno`='$invoiceno'";
	$result3 = mysqli_query($con, $qry2);
	
	
}

if(isset($_GET["billid"]))
{	
$billid = $_GET["billid"];

$sql = "SELECT * FROM `bill` WHERE `billid`='".$billid."'";

$result = $con->query($sql);
  
if ($result->num_rows > 0) {


    while($row = $result->fetch_assoc()) {
      $uid =  $row["userid"];
	  $invoiceno =  $row["invoiceno"];
	  $username =  $row["billname"];
	  $address1 =  $row["address1"];
	  $address2 =  $row["address2"];
	  $district =  $row["district"];
	  $refid    = $row["refid"];
	  $state =  $row["state"];
	  $country =  $row["country"];
	  $postalcode =  $row["postalcode"];
	  $orderstatus =  $row["orderstatus"];
	  $status =  $row["status"];
      
}

    }


?>
<div class="right_col" role="main">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Customers Details </h2>
                    
                  
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table">
                      <thead>
                        <tr>
                          <th>User Name</th>
                          <th>Invoice No</th>
                          <th>Address</th>
                          <th>Status</th>
                      
						 
                        </tr>
                      </thead>
                     <tbody>
					  <tr>
					  <td><?php echo $username;?></td>
					  <td><?php echo $invoiceno; ?></td>
					  <td><?php echo $address1."," .$address2. "<br>" .$district. "," .$state. "<br>" .$country. "<br>" .$postalcode; ?></td>
					  <td> <?php
					  if($orderstatus==2){
						  echo "Order Completed";
					  }elseif($status==1){
						  
						  echo "<form method='get' action='vieworder.php'>
						  <input type='hidden' value=".$billid." name='billid'>
						  <input type='hidden' value=".$invoiceno." name='invoiceno'>
						  <input type='submit' class='btn btn-success' value='Accept' name='accept'>
						  </form>";
					  } elseif($status==2){
						  echo "Order Accepted by Distributor<br>Distributor Name :";
						  $sql = "SELECT * FROM `users` WHERE `uid`='".$refid."'";

							$result = $con->query($sql);
							  
							if ($result->num_rows > 0) {


								while($row = $result->fetch_assoc()) {
								  echo $dname =  $row["username"];
								}
							}
							echo "<br>Distributor id :" .$refid;
					  }elseif($status==3){
						  echo "Order Accepted by admin";
					  }
					  ?>
					  </td>
					  </tr>
					  <tr>
					  <th> <h2>Product Details </h2></th>
					  </tr>
					  <tr>
					  <th>ITEM</th>
					  <th>Qty</th>
					  </tr>
					  <?php						
			$sql = "SELECT `billdetail_id`, `txnid`, `pid`, `qty` FROM `billdetail` WHERE `txnid`='$invoiceno' ";
			$result = $con->query($sql);
			if ($result->num_rows != 0)
				{
					while($row = $result->fetch_assoc())
			{
			$pid =  $row["pid"];
			$qty =  $row["qty"];
			
			?>
			<tr>
			<td><?php 
$sql3 = "SELECT `pname` FROM `product` WHERE `pid`='".$pid."'";

			$result3 = $con->query($sql3);
			  
			if ($result3->num_rows > 0) {


			while($row3 = $result3->fetch_assoc()) {
			 echo $pname =  $row3["pname"];
			}
			}
			
			
			?> </td>
			<td><?php echo $qty; ?></td>
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
}
include "static/footer.php";
	
} else{
header('Location: ./index.php');
}
} else {

header('Location: login.php');

}
?>