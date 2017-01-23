<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {

if($_SESSION["role"] == 1) {

$uid = $_SESSION["uid"];
$role = $_SESSION["role"];

include "static/head.php";
include "static/sidebar.php";
include "static/header.php";

if(isset($_POST['btn-submit']) && isset($_POST['cat_id']) &&isset($_POST['subcategoryname']))
{
	//print_r($_POST);
	$cat_id = $_POST['cat_id'];	
	$subcategoryname = $_POST['subcategoryname'];
	$subcategoryname1 = $_POST['subcategoryname1'];
	$sub_cat_id = $_POST['sub_cat_id'];
	$sub_cat_status = $_POST['sub_cat_status'];
	$error="";
	$success="";
	$status = "OK";
	if($cat_id=="")
	{
		$error .= "Please Choose the Catagory Name";
		$status = "NOTOK";
	}
	if($subcategoryname=="")
	{
		$error .= "Please Fill the Sub Catagory Name";
		$status = "NOTOK";
	}
	if($subcategoryname != $subcategoryname1)
	{
		$query_tofind = "SELECT `subcategoryname` FROM `productsubcategory` WHERE `subcategoryname`='".$subcategoryname."'";
		$query_tofind_res = $con->query($query_tofind);
		if($query_tofind_res->num_rows > 0)
		{
			$error .= "Please Choose Different Sub catagory Name. This name alreay Exist.";
			$status = "NOTOK";
		}
	}
	if($status=="OK")
	{
		$query = "UPDATE `productsubcategory` SET `cat_id`=".$cat_id.",`subcategoryname`='".$subcategoryname."',`status`=".$sub_cat_status." WHERE `subcat_id` = ".$sub_cat_id."";
		$result = mysqli_query($con, $query);
		if($result)
		{	
			$success = "Sub Category Updated Successfully!";		
		}
		else
		{
			$error = "Sorry your information not saved".mysql_error();
		}
	}
}	
?>
<div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Sub Category</h3>
              </div>
			   <span style="float: right;"><a href="addsub_catagory.php" class="btn btn-warning">Back</a></span>
</div>  
         
            <div class="clearfix"></div>
            <div class="row">              
				<div class="x_content">
				<?php 
			if($success != "")
			{
			?>
			<div class="row">
				<div class="alert alert-success">
				<?php echo $success;?>
				</div>
			<?php
			}
				if($error != "")
				{
			?>
			<div class="alert alert-danger">
				<?php echo $error ; ?>
			</div>
			<?php		
				}
			?>
			</div>  
				  <?php
				  if(isset($_GET['sub_cat_id']))
					{
						if($_GET['sub_cat_id'] != "")
						{
							$sub_cat_id = $_GET['sub_cat_id'];
							$query_subcat_name = "SELECT productcategory.catname, productsubcategory.subcategoryname, productsubcategory.subcat_id, productsubcategory.status FROM productsubcategory INNER JOIN productcategory ON productcategory.cat_id=productsubcategory.cat_id WHERE productsubcategory.subcat_id = ".$sub_cat_id."";
							$query_run = $con->query($query_subcat_name);
							if($query_run->num_rows > 0)
							{
								$row_sub_cat = $query_run->fetch_assoc();
								$cat_name = $row_sub_cat['catname'];
								$sub_cat_id = $row_sub_cat['subcat_id'];
								$subcategoryname = $row_sub_cat['subcategoryname'];
								$status = $row_sub_cat['status'];
							
					?>					  
				  <form id="from2" name="subcategoryfrom" class="form-horizontal form-label-left" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
					<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Choose Category Name 
					</label>
					 <div class="col-md-6 col-sm-6 col-xs-12">
					<select class="form-control col-md-7 col-xs-12" for="first-name" style="font-size: 16px;" name="cat_id">
						<option>Please Choose Catagory Name</option>	
					<?php 
					$query_catname = "SELECT `cat_id`, `catname` FROM `productcategory` WHERE `status` = 1";
					$query_run = $con->query($query_catname);
					if($query_run->num_rows > 0)
					{
						while($row_cat = $query_run->fetch_assoc())
						{
							$cat_id = $row_cat['cat_id'];
							$cat_name1 = $row_cat['catname'];
					?>
						<option value="<?php echo $cat_id;?>" <?php if($cat_name == $cat_name1) echo "selected='selected'"; else echo "";?>><?php echo $cat_name1;?></option>
					<?php
						}
					}
					?> 
					</select>
					</div>
					
				  </div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Sub Catagory Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat_id; ?>">
						  <input type="hidden" name="subcategoryname1" value="<?php echo $subcategoryname; ?>">
                          <input type="text" name="subcategoryname"  class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $subcategoryname;?>">						  
                        </div>
					</div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sub Catagory Status
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <select class="form-control col-md-7 col-xs-12" for="first-name" style="font-size: 16px;" name="sub_cat_status">
							<option value="1" <?php if($status == 1) echo "selected='selected'"; else echo "";?>>Active</option>
							<option value="2" <?php if($status == 2) echo "selected='selected'"; else echo "";?>>In-Active</option>
                          </select>						  
                        </div>
					</div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <input type="submit" name="btn-submit" class="btn btn-success" value="Submit">
						</div>
					 </form>
					 <?php
						}
						}
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