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
	if(isset($_POST['submit']))
	{
		if(isset($_POST['cou_name'])&& isset($_POST['cou_amt'])&& isset($_POST['no_of_users']) && isset($_POST['cou_valid']) && isset($_POST['status']))
		{
			print_r($_POST);	
			function test_input($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				return $data;
			}	
			$error="";
			$sub_status = "OK";
			$coupon_id = test_input($_POST['coupon_id']);
			$cou_name = test_input($_POST['cou_name']);
			$cou_amt = test_input($_POST['cou_amt']);
			$no_of_users = test_input($_POST['no_of_users']);
			$cou_valid = test_input($_POST['cou_valid']);
			$status = test_input($_POST['status']);
			if($cou_name=="" || $cou_amt=="" || $no_of_users=="" || $cou_valid=="" || $status=="" )
			{
				$error .= "YOU MISSED SOME FIELD";
				$sub_status = "notok";
			}
			else
			{
				if(!preg_match("/^[a-zA-Z0-9 ]*$/",$cou_name))
				{
					$error .= " Coupon Code name Only letters and numbers allowed.<br>";
					$sub_status = "notok";
				}
				if(!is_numeric($cou_amt))
				{
					$error .= " Coupon Amount Only numbers allowed.<br>";
					$sub_status = "notok";
				}
				if(!is_numeric($no_of_users))
				{
					$error .= "No of Users field Only numbers allowed.<br>";
					$sub_status = "notok";
				}
			}
			if($sub_status == "OK")
			{
				$cou_query = "UPDATE `coupon` SET `coupon_name`='".$cou_name."',`coupon_amount`=".$cou_amt.",`no_of_users`=".$no_of_users.",`validity`='".$cou_valid."',`status`=".$status." WHERE `coupon_id`= ".$coupon_id."";
				$cou_code_run = $con->query($cou_query);
				if($cou_code_run)
				{
					$success = "Coupon code added successfullly";
				}
				else
				{
					$error .= "Sorry ".$con->error;
				}
			}
		}
	}
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Coupon Code</h3>
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
						<a href="view_coupon.php" class="btn btn-primary">Back</a>
						<a href="index.php" class="btn btn-success">Home</a>
					<?php
					}
					?> 
					
					<?php if($success != "")
					{
					?>
						<div class="alert-success" style="padding: 19px; margin-bottom: 16px; font-size: 20px;"><?php echo $success;?></div>
						<a href="view_coupon.php" class="btn btn-primary">Back</a>
						<a href="index.php" class="btn btn-success">Home</a>
					<?php
					}
					?>
					<?php 
					if(!$_POST)
					{
						if($_GET['coupon_id'])
						{
							$coupon_id = $_GET['coupon_id'];
							$query_coup = "SELECT `coupon_id`, `coupon_code`, `coupon_name`, `coupon_amount`, `no_of_users`, `validity`, `status` FROM `coupon` WHERE `coupon_id` = ".$coupon_id."";
							$query_coup_run = $con->query($query_coup);
							if($query_coup_run->num_rows > 0)
							{
							while($row = $query_coup_run->fetch_assoc())
							{
								$coupon_id = $row['coupon_id'];
								$coup_code = $row['coupon_code'];
								$coup_name = $row['coupon_name'];
								$coup_amount = $row['coupon_amount'];
								$coup_no_users = $row['no_of_users'];
								$coup_valid = $row['validity'];
								$status = $row['status'];
					?>
					<form id="demo-form2" name="demo-form2" class="form-horizontal form-label-left" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Coupon Code<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $coup_code;?>
                        </label>
						  <input type="hidden" name="coupon_id" value="<?php echo $coupon_id;?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Coupon Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="cou_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $coup_name;?>"placeholder="Enter Coupon Name">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Coupon Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="cou_amt" required="required" class="form-control col-md-7 col-xs-12"value="<?php echo $coup_amount;?>" placeholder="Enter the Coupon amount">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No of Users <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="no_of_users" required="required" class="form-control col-md-7 col-xs-12"value="<?php echo $coup_no_users;?>" placeholder="Enter the number user to use this coupon code">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12" required="required">Valid till <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="date" name="cou_valid" value="<?php echo $coup_valid;?>">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span>
                        </label>																	
						
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="cat_id" class="form-control col-md-7 col-xs-12" name="status" required="required" value="<?php echo $status;?>">
							  <option value="">--- Select Status ---</option>
							  <option value="1" <?php if($status == 1) echo "selected = 'selected'"; else echo "";?>>Active</option>
							  <option value="2" <?php if($status == 2) echo "selected = 'selected'"; else echo "";?>>In-Active</option>
							  <option value="3" <?php if($status == 3) echo "selected = 'selected'"; else echo "";?>>Pending</option>
                          </select>
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
							}
							}
							else
							{
								echo "no query";
								
							}
						}
					}
					?>
                  </div>
                </div>
              </div>
            </div>
   </div>
</div>
<?php
include "static/footer.php";
} 
else
{
header('Location: ./index.php');
}
}
else 
{
header('Location: login.php');
}
?>