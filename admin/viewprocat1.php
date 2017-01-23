<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {

if($_SESSION["role"] == 1) {

$uid = $_SESSION["uid"];
$role = $_SESSION["role"];

include "static/head.php";
include "static/sidebar.php";
include "static/header.php";

include "random_images_rename1.php";
if(isset($_GET['cat_id'])){
 $id = $_GET['cat_id'];
 $sql = "SELECT * FROM `productcategory` WHERE `cat_id`='".$id."'";
$result = $con->query($sql);
 
if ($result->num_rows > 0) {
 

    while($row = $result->fetch_assoc()) {
		$cat_id =  $row["cat_id"];
       $catname =  $row["catname"];
	   $catimage =  $row["catimage"];	                          
}
}
}
?>
<?php
if(isset($_POST['btn-submit']))
{
	$cat_id = $_POST['cat_id'];	
	$subcategoryname = $_POST['subcategoryname'];
	$error="";
	$success="";
	$status = "OK";
	if($subcategoryname=="")
	{
		$error1 = "Please Fill the Catagory Name";
	}
	if($status=="OK")
	$query = "INSERT INTO `productsubcategory`(`cat_id`,`subcategoryname`,`status`) 
				VALUES ('".$cat_id."','".$subcategoryname."',1)";
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
?>
<div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>View Category</h3>
              </div>
</div>             
            <div class="clearfix"></div>
            <div class="row">              
				<div class="x_content">
				
				<form id="demo-form2" name="demo-form2" class="form-horizontal form-label-left" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="font-size: 16px;">PRODUCT CATEGORY NAME 
					</label>
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="font-size: 16px;text-transform: uppercase;"><?php echo $catname;?> 
					</label>
				  </div>

				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-size: 16px;">Category Image</label><br />
					<div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="uploads/category/<?php echo $catimage;?>" width="350px" height="200px">
					</div>
				  </div>
				</form>
				</div>
            </div>
			<div class="clearfix"></div>
            
			<?php 
			if($success!="")
			{
			?>
			<div class="row">
				<div class="alert alert-success">
				<?php echo $success;?>
				</div>
			<?php
			}
				if($error1!="")
				{
			?>
			<div class="alert alert-danger">
				<?php echo $error1; ?>
			</div>
			</div>
			<?php		
				}
			?>
			
			
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
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sub_cat_query = "SELECT `subcat_id`, `subcategoryname` FROM `productsubcategory` WHERE `cat_id`=".$cat_id." AND `status`=1";
					$sub_cat_query_run = $con->query($sub_cat_query);
					if($sub_cat_query_run->num_rows > 0)
					{
						
						$i = 1;
						while($sub_cat_query_row = $sub_cat_query_run->fetch_assoc())
						{
							$sub_cat_id = $sub_cat_query_row['subcat_id'];
							$sub_cat_name = $sub_cat_query_row['subcategoryname'];
						
					?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $sub_cat_name;?></td>
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