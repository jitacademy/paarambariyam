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
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Inventory Add</h3>
              </div>
</div>
             
            <div class="clearfix"></div>
            <div class="row">
              
                  <div class="x_content">
                    <br />
					<?php if($error != "")
					{
					?>
						<div class="alert-danger" style="padding: 19px; margin-bottom: 16px; font-size: 20px;"><?php echo $error;?></div>
					<?php
					}
					?> 
					<div><?php echo $error;?></div>
					
					<?php if($success != "")
					{
					?>
						<div class="alert-success" style="padding: 19px; margin-bottom: 16px; font-size: 20px;"><?php echo $success;?></div>
					<?php
					}
					?>                    
					<form id="demo-form2" name="demo-form2" class="form-horizontal form-label-left" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="pid" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $pid;?>"placeholder="Product ID">
                        </div>
                      </div>
                      			  
					  <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="product.php" class="btn btn-primary">Cancel</a>
                          <input type="submit" name="submit" class="btn btn-success" value="submit">
                        </div>
                      </div>
                    </form>
					<?php
					if(isset($_POST['submit']))
					{
						function test_input($data)
						{
							$data = trim($data);
							$data = stripslashes($data);
							return $data;
						}	
							$pid=test_input($_POST['pid']);	
							$success="";
							$error="";
							$statusqty="ok";
							if(!is_numeric($pid))
							{
								$error .= "Product Id must be Numeric";
								$statusqty = "notok";
							}
							if($pid=="")
							{
								$error .= "Product Id must be Fill";
								$statusqty = "notok";
							}
							if($statusqty=="ok")
							{
								$sql = "SELECT `pid`, `pname`, `status`,`qty` FROM `product` WHERE `pid`=".$pid."";
								$result = $con->query($sql);
								if ($result->num_rows > 0) 
								{
					
					?>
					<table class="table">
					    <thead>
						<tr>
                          <th>Product ID</th>
                          <th>Product Name</th>
						  <th>Status</th>
                          <th>Quantity</th>
						  <th>Update Quantity</th>						  
                        </tr>
						<tr>
						
						</tr>
                      </thead>
					  <tbody>
					 <?php						
							while($row = $result->fetch_assoc()) 
							{
							   $pid =  $row["pid"];
							   $pname = $row["pname"];
							   $status = $row["status"];
							   $qty = $row["qty"];
					?>
						<tr>
							<td><?php echo $pid; ?></td>
							<td><?php echo $pname; ?></td>
							<td><?php if($status == 1) echo "Active"; else echo "Inactive";?></td>
							<td><?php echo $qty; ?> </td>
							<td>
								<form id="demo-form2" name="demo-form2" class="form-horizontal form-label-left" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<input type="text" name="qtyadd" value="" required="required">
									<input type="hidden" name="qty" value="<?php echo $qty;?>">
									<input type="hidden" name="pid" value="<?php echo $pid;?>">
									<input type="submit" name="qtysubmit" >
								</form>
							</td>
						</tr>					     
					  </tbody>
					  </table>
					  <?php
							}
							}
							else
							{
						?>
								<div class ="alert alert-info">
									Sorry There no Product ID
								</div>
						<?php	
							}						
						}
						}
					?> 
					<?php
					if($error != "")
					{
					?>
					<div class ="alert alert-danger">
						<?php echo $error;?>
					</div>
					<?php
					}
					?>
					<?php
					if(isset($_POST['qtysubmit']) && isset($_POST['qty']) && isset($_POST['qtyadd']) && isset($_POST['pid']))
					{
						$error_qtyadd = "";
						$success_qtyadd = "";
						$status_qtyadd = "ok";
						$pid = $_POST['pid'];
						$qty = $_POST['qty'];
						$qtyadd = $_POST['qtyadd'];
						if($qtyadd=="")
						{
							$error_qtyadd .= "Please fill the Update quatity before Submit";
							$status_qtyadd = "notok";
						}
						if(!is_numeric($qtyadd))
						{
							$error_qtyadd .= "Update Quatity must be Numeric";
							$status_qtyadd = "notok";
						}
						if($status_qtyadd == "ok")
						{
							$qty_total = $qty + $qtyadd;
							$query_qty_update = "UPDATE `product` SET `qty`=".$qty_total."  WHERE `pid` =".$pid."";
							$run_qty_update = $con->query($query_qty_update);
							if($run_qty_update)
							{
								$success_qtyadd = "Quantity Added Successfully";
							}
							else
							{
								echo "Sorry Something happening".$con->error;								
							}
						}
					}
					?>
					<?php
					if($success_qtyadd != "")
					{
					?>
					<div class ="alert alert-success">
						<?php echo $success_qtyadd;?>
					</div>
					<?php
					}
					else if($error_qtyadd != "")
					{
					?>
					<div class ="alert alert-danger">
						<?php echo $error_qtyadd;?>
					</div>
					<?php
					}
					?>
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
