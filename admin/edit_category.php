<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {



if($_SESSION["role"] == 1) {

$uid = $_SESSION["uid"];
$role = $_SESSION["role"];

include "static/head.php";
include "static/sidebar.php";
include "static/header.php";
if(isset($_POST['addproduct']))
{
function test_input($data)
{	
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}	
	$cat_id=test_input($_POST['cat_id']);
	$catname1=test_input($_POST['catname1']);
	$catname=test_input($_POST['catname']);
	$catstatus = $_POST['catstatus'];
	//print_r($_FILES);
	if($_FILES['catimage']['name'] != "")
	{
		include "random_images_rename1.php";
	}
	else
	{
		$catimage = $_POST['image'];
	}
	$success="";
	$error="";
	$status="ok";
	if(!preg_match("/^[a-zA-Z0-9 ]*$/",$catname))
	{
		
		$error .= " Category Name field Only letters and whitespace allowed.<br>";
		$status = "notok";
	}
	$sql = "SELECT * FROM `productcategory` WHERE `catname`='".$catname."'";
	$result = $con->query($sql);
	if($catname != $catname1)
	{
		if ($result->num_rows > 0) 
		{
			$error .= "The category Name already exists.<br>";
			$status = "NOTOK";
		}
	}
	if($status == "ok")
	{
		$query = "UPDATE `productcategory` SET `catname`='".$catname."',`catimage`='".$catimage."',`status`=".$catstatus." WHERE `cat_id`=".$cat_id."";
		$result = mysqli_query($con, $query); 
						
		if($result)
		{
			
			$success = "Your information saved successfully";
			
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
                <h3>Edit Category</h3>
              </div>
			  <span style="float: right;"><a href="product-category.php" class="btn btn-warning">Back</a></span>
</div>             
            <div class="clearfix"></div>
            <div class="row">
                  <div class="x_content">  
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
				if($error!="")
				{
			?>
			<div class="alert alert-danger">
				<?php echo $error; ?>
			</div>
			</div>
			<?php		
				}
			?>				  
					<form method ="POST" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" class="form-horizontal form-label-left">
					<?php
					if($_GET['cat_id']!="")
					{
						$cat_id = $_GET['cat_id'];
						$sel_cat_query = "SELECT `cat_id`, `catname`, `catimage`, `status` FROM `productcategory` WHERE `cat_id` = ".$cat_id."";
						$sel_cat_query_run = $con->query($sel_cat_query);
						if($sel_cat_query_run->num_rows == 1)
						{
							$sel_row = $sel_cat_query_run->fetch_assoc();
							$cat_id = $sel_row['cat_id'];
							$catname = $sel_row['catname'];
							$catimage = $sel_row['catimage'];
							$catstatus = $sel_row['status'];
						}
					}
					?>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Catagory Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="catname" placeholder="Product Category Name" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $catname;?>">				  
                        </div>
					</div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<?php 
						if($catimage != "")
						{
						?>
						<img src="uploads/category/<?php echo $catimage;?>" width="350px" height="200px">
						<?php
						}
						?>
						<input type="hidden" name="catname1" value="<?php echo $catname;?>">
						<input type="hidden" name="cat_id" value="<?php echo $cat_id;?>">
						<input type="hidden" name="image" value="<?php echo $catimage;?>">
						<input type="file" name="catimage"  placeholder="Product Category Image" class="form-control col-md-7 col-xs-12">				  
                        </div>
					</div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Catagory Status
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <select class="form-control col-md-7 col-xs-12" for="first-name" style="font-size: 16px;" name="catstatus">
							<option value="1" <?php if($catstatus == 1) echo "selected='selected'"; else echo "";?>>Active</option>
							<option value="2" <?php if($catstatus == 2) echo "selected='selected'"; else echo "";?>>In-Active</option>
                          </select>						  
                        </div>
					</div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input type="submit" name="addproduct" value="Update Product category" class="btn" style="background: #3aaaa3; color: white;">			  
                        </div>
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
