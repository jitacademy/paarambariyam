<?php
require "includes/connect.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
	if($_SESSION["role"] == 1) 
	{
		include "static/head.php";
		include "static/sidebar.php";
		include "static/header.php";
		if($_GET['coupon_id']!="")
		{
			$coupon_id = $_GET['coupon_id'];
			$del_coup_query = "UPDATE `coupon` SET `status`= 2 WHERE `coupon_id` = ".$coupon_id."";
			$del_coup_query_run = $con->query($del_coup_query);
			if($del_coup_query_run)
			{
				$success_delete = "You have Deleted Coupon Code Successfully";
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
	<a href="view_coupon.php" class="btn btn-warning" >Back</a>
	<a href="index.php" class="btn btn-info" >Home</a>
</div>
<?php
	include "static/footer.php";
?>