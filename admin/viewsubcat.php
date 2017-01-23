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
            <div class="page-title">
              <div class="title_left">
                <h3>View Sub Category</h3>
              </div>
			  <span style="float: right;"><a href="addsub_catagory.php" class="btn btn-warning">Back</a></span>
</div>             
            <div class="clearfix"></div>
            <div class="row">              
				<div class="x_content">
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
								$row_cat = $query_run->fetch_assoc();
								$cat_name = $row_cat['catname'];
								$sub_cat_id = $row_cat['subcat_id'];
								$subcategoryname = $row_cat['subcategoryname'];
								$status = $row_cat['status'];
							
					?>
				  <form id="from2" name="subcategoryfrom" class="form-horizontal form-label-left" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
					<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Name </label>
					 <div class="col-md-6 col-sm-6 col-xs-12">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $cat_name;?></label>
					</div>					
				  </div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sub Catagory Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $subcategoryname;?></label>
						</div>
					</div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sub Catagory Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php if($status == 1) echo "Active"; else echo "In-Active"; ?></label>
						</div>
					</div>
					
			</form>
			<?php
							}
							else
							{
							?>
							<div class="alert alert-info">Sorry No rows selected</div> 
							<?php
							}
				 
						}
					}
			?>
						
			<div class="clearfix"></div>
			<div class="page-title">
					<div class="title_left">
						<h3>View Sub - Category Products</h3>
					</div>
				</div>      				  
				  <form id="from2" name="subcategoryfrom" class="form-horizontal form-label-left" method="post" action="" enctype="multipart/form-data">
				  <table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Product ID</th>
							<th>Product Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sub_cat_query = "SELECT `pid`,  `pname`, `status` FROM `product` WHERE `subcat_id`=".$sub_cat_id."";
					$sub_cat_query_run = $con->query($sub_cat_query);
					if($sub_cat_query_run->num_rows > 0)
					{						
						$i = 1;
						while($sub_cat_query_row = $sub_cat_query_run->fetch_assoc())
						{
							$pid = $sub_cat_query_row['pid'];
							$pname = $sub_cat_query_row['pname'];
							$status_check = $sub_cat_query_row['status'];
						
					?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $pid;?></td>
							<td><?php echo $pname;?></td>
							<td><?php if($status_check == 1) echo "Active"; else echo "In-Active";?></td>
							<td>
							  <a href="viewpro1.php?pid=<?php echo $pid; ?>" class="btn btn-success">View</a> 
							  <a href="editpro_check.php?pid=<?php echo $pid; ?>" class="btn btn-info">Edit</a>
							  <?php 
							  if($status == 1)
							  {
							  ?>
								<a href="deleteprod.php?pid=<?php echo $pid; ?>" class="btn btn-danger">Delete</a>
							  <?php
							  }
							  else
							  {
							  ?>
							  <a href="activateprod.php?pid=<?php echo $pid; ?>" class="btn btn-primary">Activate</a>
							  <?php
							  }
							  ?>
						  </td>
						</tr>
							
                        
					<?php
							$i++;
						}
					}
					else
					{
						echo "<div class='alert alert-info'>No Sub catogory for this Catagory</div>";
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