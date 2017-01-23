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
if(isset($_POST['addproduct']))
{
function test_input($data)
{
	
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}	
	$catname=test_input($_POST['catname']);	
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

			if ($result->num_rows > 0) 
			{
				$error .= "The category Name already exists.<br>";
				$status = "NOTOK";
			}
			if($status == "ok")
			{
				$query = "INSERT INTO `productcategory`(`catname`,`catimage`,`status`) VALUES ('".$catname."','".$catimage."','1')";
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
                <h3>Add new Category</h3>
              </div>
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
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Catagory Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="catname" placeholder="Product Category Name" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $catname;?>">				  
                        </div>
					</div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input type="file" name="catimage"  placeholder="Product Category Image" class="form-control col-md-7 col-xs-12" required="required" >				  
                        </div>
					</div>	
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input type="submit" name="addproduct" value="Add Product category" class="btn" style="background: #3aaaa3; color: white;">				  
                        </div>
					</div>						
						
					</form>
					<table class="table">
                        <tr>
                          <th>#</th>
                          <th>Category Name</th>
						  <th>Status</th>
                          <th>Action</th>
						  
						  
                        </tr>
                      </thead>
                      <tbody>
					  <?php
$sql = "SELECT * FROM `productcategory` ORDER BY cat_id DESC";
$result = $con->query($sql);
if ($result->num_rows > 0) 
{
	$i = 1;
    while($row = $result->fetch_assoc()) 
	{
       $cat_id =  $row["cat_id"];
       $catname = $row["catname"];
       $status = $row["status"];
       
?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $catname; ?></td>
			<td><?php if($status == 1) echo "Active"; else echo "Inactive";?></td>
			<td>
				<a href="viewprocat1.php?cat_id=<?php echo $cat_id; ?>" class="btn btn-success">View</a>
				<a href="edit_category.php?cat_id=<?php echo $cat_id; ?>" class="btn btn-warning">Edit</a>  
				<?php if($status == 1) 
				{
				?>
				<a href="deletecat.php?cat_id=<?php echo $cat_id;?>" class="btn btn-danger" >Delete</a>
				<?php
				}
				else
				{
				?>
				<a href="activatecat.php?cat_id=<?php echo $cat_id; ?>" class="btn btn-primary">Activate</a>
				<?php
				}
				?>
			</td>
		</tr>
<?php
	$i++;                        
	}
    }
?>                      </tbody>
                    </table>
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
