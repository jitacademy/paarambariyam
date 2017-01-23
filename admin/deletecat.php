<?php
require "includes/connect.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
	if($_SESSION["role"] == 1) 
	{
		include "static/head.php";
		include "static/sidebar.php";
		include "static/header.php";
		if($_GET['cat_id']!="")
		{
			$cat_id = $_GET['cat_id'];
			$del_cat_query = "UPDATE `productcategory` SET `status`=2 WHERE `cat_id`=".$cat_id."";
			$del_cat_query_run = $con->query($del_cat_query);
			if($del_cat_query_run)
			{
				$del_sub_cat_query = "UPDATE `productsubcategory` SET `status`=2 WHERE `cat_id`=".$cat_id."";
				$del_sub_cat_query_run = $con->query($del_sub_cat_query);
				if($del_sub_cat_query_run)
				{
					$success_delete = "You have Deleted Catagory and Sub-Catagory Successfully";
				}
				else
				{
					echo "Sorry".$con->error;
				}
			}
		}
	}
}
?>
<div class="right_col" role="main" style="padding: 134px 15px 18px 15px;">
	<div class="alert alert-success">
		<?php echo $success_delete;?>		
	</div>
	<a href="product-category.php" class="btn btn-warning" >Back</a>
	<a href="index.php" class="btn btn-info" >Home</a>
</div>
<?php
	include "static/footer.php";
?>