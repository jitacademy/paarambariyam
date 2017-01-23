<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"]))
{
if($_SESSION["role"] == 1) 
{
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
                <h3>View Coupon Code</h3>
              </div>
			</div>
			<?php
			if(isset($_GET['coupon_id']))
			{
				$coupon_id = $_GET['coupon_id'];
				
			?>
            <div class="clearfix"></div>
            <div class="row">              
                  <div class="x_content">
                    <br />
					<?php
					$query_coup = "SELECT `coupon_id`, `coupon_code`, `coupon_name`, `coupon_amount`, `no_of_users`, `validity`, `status` FROM `coupon` WHERE `coupon_id` = ".$coupon_id."";
					$query_coup_run = $con->query($query_coup);
					while($row = $query_coup_run->fetch_assoc())
					{
						//print_r($row);
						$coupon_id = $row['coupon_id'];
						$coup_code = $row['coupon_code'];
						$coup_name = $row['coupon_name'];
						$coup_amount = $row['coupon_amount'];
						$coup_no_users = $row['no_of_users'];
						$coup_valid = $row['validity'];
						$status = $row['status'];
					}
					?>
					<form id="demo-form2" name="demo-form2" class="form-horizontal form-label-left">
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Coupon Code 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $coup_code;?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Coupon Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left; width: 100%;"><?php echo $coup_name;?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Coupon Amount 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $coup_amount;?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No of Users  
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $coup_no_users;?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Validity 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $coup_valid;?></label>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $status;?></label>
                        </div>
                      </div>
					  
					  <div class="ln_solid"></div>
					  <div style="text-align: center;">
						<a href="view_coupon.php" class="btn btn-warning">Back</a>
						<a href="index.php" class="btn btn-info" >Home</a>
					</div>
                    </form>
                  </div>
                </div>
				<?php
				}
				else
				{
					echo "<div class='alert alert-danger' style='margin-top: 63px;'>Sorry You are come wrong way</div>"; 
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