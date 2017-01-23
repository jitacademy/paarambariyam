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
		if(isset($_POST['cou_code']) && isset($_POST['cou_name'])&& isset($_POST['cou_amt'])&& isset($_POST['no_of_users']) && isset($_POST['cou_valid']) && isset($_POST['status']))
		{
			//print_r($_POST);exit;	
			function test_input($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				return $data;
			}	
			$error="";
			$sub_status = "OK";
			$cou_code = test_input($_POST['cou_code']);
			$cou_name = test_input($_POST['cou_name']);
			$cou_amt = test_input($_POST['cou_amt']);
			$no_of_users = test_input($_POST['no_of_users']);
			$cou_valid = test_input($_POST['cou_valid']);
			$status = test_input($_POST['status']);
			if($cou_code=="" || $cou_name=="" || $cou_amt=="" || $no_of_users=="" || $cou_valid=="" || $status=="" )
			{
				$error .= "YOU MISSED SOME FIELD";
			}
			else
			{
				$cou_code_query = "SELECT `coupon_code` FROM `coupon` WHERE `coupon_code`='".$cou_code."'";
				$cou_code_run = $con->query($cou_code_query);
				if($cou_code_run->num_rows > 0)
				{
					$error .= " The coupon code entered Already Exit.<br>";
					$sub_status = "notok";
				}
				if(!ctype_alnum($cou_code))
				{
					$error .= " The coupon code having only Numeric and Alphabets.<br>";
					$sub_status = "notok";
				}
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
				$cou_query = "INSERT INTO `coupon`(`coupon_code`, `coupon_name`, `coupon_amount`, `no_of_users`, `validity`, `status`) VALUES ('".$cou_code."','".$cou_name."',".$cou_amt.",".$no_of_users.",'".$cou_valid."',".$status.")";
				$cou_query_run = $con->query($cou_query);
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
                <h3>Add New Coupon</h3>
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
						<a href="new_coupon.php" class="btn btn-primary">Back</a>
						<a href="index.php" class="btn btn-success">Home</a>
					<?php
					}
					?> 
					
					<?php if($success != "")
					{
					?>
						<div class="alert-success" style="padding: 19px; margin-bottom: 16px; font-size: 20px;"><?php echo $success;?></div>
						<a href="new_coupon.php" class="btn btn-primary">Back</a>
						<a href="index.php" class="btn btn-success">Home</a>
					<?php
					}
					?>
					<?php 
					if(!$_POST)
					{
					?>
					<form id="demo-form2" name="demo-form2" class="form-horizontal form-label-left" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Coupon Code<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="cou_code" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $cou_code;?>"placeholder="Enter Coupon Code">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Coupon Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="cou_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $cou_name;?>"placeholder="Enter Coupon Name">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Coupon Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="cou_amt" required="required" class="form-control col-md-7 col-xs-12"value="<?php echo $cou_amt;?>" placeholder="Enter the Coupon amount">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No of Users <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="no_of_users" required="required" class="form-control col-md-7 col-xs-12"value="<?php echo $no_of_users;?>" placeholder="Enter the number user to use this coupon code">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12" required="required">Valid till <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="date" name="cou_valid" value="<?php echo $cou_valid;?>">
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
					?>
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