<?php
require "includes/connect.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
	if($_SESSION["role"] == 1) 
	{
		include "static/head.php";
		include "static/sidebar.php";
		include "static/header.php";
		if($_GET['status']!="")
		{
			 $status = $_GET['status'];
			 $del_prod_query = "UPDATE `order_history` SET `status`= 3 WHERE `status` = 1 ";
			$del_prod_query_run = $con->query($del_prod_query);
			if($del_prod_query_run)
			{
				$success_delete = "You have Deleted  Complete Order Successfully";
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
	<a href="sales.php" class="btn btn-warning" >Back</a>
	<a href="index.php" class="btn btn-info" >Home</a>
</div>
<?php
	include "static/footer.php";
?>