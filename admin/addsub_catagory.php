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
	$cat_id = $_POST['cat_id'];	
	$subcategoryname = $_POST['subcategoryname'];
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
	$query_tofind = "SELECT `subcategoryname` FROM `productsubcategory` WHERE `subcategoryname`='".$subcategoryname."'";
	$query_tofind_res = $con->query($query_tofind);
	if($query_tofind_res->num_rows > 0)
	{
		$error .= "Please Choose Different Sub catagory Name. This name alreay Exist.";
		$status = "NOTOK";
	}
	if($status=="OK")
	{
		$query = "INSERT INTO `productsubcategory`(`cat_id`,`subcategoryname`,`status`) VALUES ('".$cat_id."','".$subcategoryname."',1)";
		$result = mysqli_query($con, $query);
		if($result)
		{	
			$success = "Sub Category Added Successfully!";		
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
                <h3>Add New Sub Category</h3>
              </div>
</div>             
            <div class="clearfix"></div>
            <div class="row">              
				<div class="x_content">
				    				  
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
							$cat_name = $row_cat['catname'];
					?>
						<option value="<?php echo $cat_id;?>"><?php echo $cat_name;?></option>
					<?php
						}
					}
					?> 
					</select>
					</div>
					
				  </div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Add Product Sub Catagory 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>"class="form-control col-md-7 col-xs-12">
                          <input type="text" name="subcategoryname"  class="form-control col-md-7 col-xs-12" required="required">						  
                        </div>
					</div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <input type="submit" name="btn-submit" class="btn btn-success" value="Submit">
						</div>
					 </form>
            </div>
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
			
			<div class="clearfix"></div>
			<div class="page-title">
					<div class="title_left">
						<h3>View Sub - Category</h3>
					</div>
				</div>      				  
				  <form id="from2" name="subcategoryfrom" class="form-horizontal form-label-left" method="post" action="" enctype="multipart/form-data">
				  <table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Sub Catagory Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sub_cat_query = "SELECT `subcat_id`, `cat_id`, `subcategoryname`, `status` FROM `productsubcategory`";
					$sub_cat_query_run = $con->query($sub_cat_query);
					if($sub_cat_query_run->num_rows > 0)
					{						
						$i = 1;
						while($sub_cat_query_row = $sub_cat_query_run->fetch_assoc())
						{
							$sub_cat_id = $sub_cat_query_row['subcat_id'];
							$sub_cat_name = $sub_cat_query_row['subcategoryname'];
							$status_check = $sub_cat_query_row['status'];
						
					?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $sub_cat_name;?></td>
							<td><?php if($status_check == 1) echo "Active"; else echo "In-Active";?></td>
							<td><a href="viewsubcat.php?sub_cat_id=<?php echo $sub_cat_id;?>" class="btn btn-success">View</a>
							<a href="editsubcat.php?sub_cat_id=<?php echo $sub_cat_id;?>" class="btn btn-info">Edit</a>
							<a href="deletesubcat.php?sub_cat_id=<?php echo $sub_cat_id;?>" class="btn btn-danger">Delete</a></td>
						</tr>
							
                        
					<?php
							$i++;
						}
					}
					else
					{
						echo "No Sub catogory for this Catagory";
					}
					?>
					</tbody>
				</table>
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