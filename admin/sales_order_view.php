<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
if($_SESSION["role"] == 1) {

$uid = $_SESSION["uid"];
$role = $_SESSION["role"];

include "static/head.php";
include "static/sidebar.php";
include "static/header.php";
if(isset($_GET['pid'])){
$pid = $_GET['pid'];
$sql = "SELECT * FROM `order_history` WHERE `pid`='$pid'";
$result = $con->query($sql);
 
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) 
	{
		//print_r($row); 
			$pname =  $row["pname"];
			$brand =  $row["brand"];
			$pcode =  $row["pcode"];
			$price =  $row["price"];
			$total =  $row["total"];
			$qty = $row["qty"];
			$orderid = $row["orderid"];
			$order_date =  $row["order_date"];
			$status =  $row["status"];
			$pid = $row["pid"];		
	  	                          
}
    }
}
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>View Products</h3>
              </div>
</div>
             
            <div class="clearfix"></div>
            <div class="row">
              
                  <div class="x_content">
                    <br />
					<form id="demo-form2" name="demo-form2" class="form-horizontal form-label-left" method="post" action="" enctype="multipart/form-data">
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Order Id 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $orderid;?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $pname;?></label>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Brand Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $brand;?></label>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Code
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $pcode;?></label>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Quantity 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $qty;?></label>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $price;?></label>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php if($status == 2){echo "Pending";?><?php }else{ echo "Completed";}?></label>
                        </div>
                      </div>
					  <div class="ln_solid"></div>
					  <div style="text-align: center;">
						<a href="sales.php" class="btn btn-warning" >Back</a>
						<a href="index.php" class="btn btn-info" >Home</a>
					</div>
                    </form>
                  </div>
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