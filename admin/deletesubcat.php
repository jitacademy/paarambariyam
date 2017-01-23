<?php
require "includes/connect.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
	if($_SESSION["role"] == 1) 
	{
		include "static/head.php";
		include "static/sidebar.php";
		include "static/header.php";
		if($_GET['sub_cat_id']!="")
		{
			$sub_cat_id = $_GET['sub_cat_id'];
			$del_sub_cat_query = "UPDATE `productsubcategory` SET `status`=2 WHERE `subcat_id`=".$sub_cat_id."";
			$del_sub_cat_query_run = $con->query($del_sub_cat_query);
			if($del_sub_cat_query_run)
			{
				$success_delete = "You have Deleted Sub-Catagory Successfully";
			}
			else
			{
				echo "Sorry".$con->error;
			}
		}
	}
}
?>
<div class="right_col" role="main" style="padding: 134px 15px 18px 15px;">
	<div class="alert alert-success">
		<?php echo $success_delete;?>
		
	</div>
	<a href="addsub_catagory.php" class="btn btn-warning" >Back</a>
		<a href="index.php" class="btn btn-info" >Home</a>
</div>
<?php
	include "static/footer.php";
?>